<?php

namespace App\Console\Commands\Tmp;

use Domain\Presence\Models\Presence;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class SplitPresencesPerDayCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tmp:presences:split {--chunk=100: The Number of Presences to retrieve per chunk of Presences to be calculated}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Splitting Presences that are going into the next day into two presences';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $query = Presence::query();

        $bar = $this->output->createProgressBar($query->count());

        $bar->start();

        $query->chunkById((int) $this->option('chunk'), function (Collection $presences) use ($bar) {

            $presences->each(function (Presence $presence) use ($bar) {
                if (is_null($presence->left_at)) {
                    $bar->advance();

                    return;
                }

                if ($presence->joined_at->isSameDay($presence->left_at)) {
                    $bar->advance();

                    return;
                }

                $this->splitPresence($presence);
                $bar->advance();
            });
        });
        $bar->finish();

    }

    private function splitPresence(Presence $presence): void
    {
        $nextDayPresence = $presence->replicate();

        $presence->update([
            'left_at' => $presence->joined_at->endOfDay(),
            'playtime_minutes' => (int) $presence->joined_at->diffInMinutes($presence->joined_at->endOfDay()),
        ]);

        $dateShift = $nextDayPresence->joined_at;

        while (! $dateShift->addDay()->isSameDay($nextDayPresence->left_at)) {
            $midDayPresence = $nextDayPresence->replicate();
            $midDayPresence->fill([
                'joined_at' => $dateShift->startOfDay()->addSeconds(1),
                'left_at' => $dateShift->endOfDay(),
                'playtime_minutes' => 1440,
            ]);
            $midDayPresence->save();
        }

        $nextDayPresence->fill([
            'joined_at' => $nextDayPresence->left_at->startOfDay(),
            'playtime_minutes' => (int) $nextDayPresence->left_at->startOfDay()->diffInMinutes($nextDayPresence->left_at),
        ]);
        $nextDayPresence->save();
    }
}
