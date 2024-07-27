<?php

namespace App\Console\Commands;

use Domain\Presence\Models\Presence;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class CalculatePlaytimeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'skyblock:playtime:calculate {--chunk=20: The Number of Presences to retrieve per chunk of Presences to be calculated}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculating Playtime for finished presences';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $chunk = (int) $this->option('chunk');

        $query = Presence::query()
            ->whereNotNull('joined_at')
            ->whereNotNull('left_at')
            ->whereNull('playtime_minutes');

        $bar = $this->output->createProgressBar($query->count());

        $bar->start();

        $query->chunkById($chunk, function (Collection $presences) use ($bar) {
            $presences->each(function (Presence $presence) use ($bar) {
                $presence->update([
                    'playtime_minutes' => (int) $presence->joined_at->diffInMinutes($presence->left_at),
                ]);
                $bar->advance();
            });
        });
        $bar->finish();

    }
}
