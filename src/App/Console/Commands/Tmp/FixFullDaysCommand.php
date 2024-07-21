<?php

namespace App\Console\Commands\Tmp;

use Domain\Presence\Models\Presence;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class FixFullDaysCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tmp:presence:fix {--chunk=100: The Number of Presences to retrieve per chunk of Presences to be calculated}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix start date of full day presences';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $query = Presence::query()
            ->where('playtime_minutes', 1440);

        $bar = $this->output->createProgressBar($query->count());

        $bar->start();

        $query->chunkById((int) $this->option('chunk'), function (Collection $presences) use ($bar) {

            $presences->each(function (Presence $presence) use ($bar) {
                $presence->update([
                    'joined_at' => $presence->joined_at->startOfDay(),
                ]);
                $bar->advance();
            });
        });
        $bar->finish();

    }
}
