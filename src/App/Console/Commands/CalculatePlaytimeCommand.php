<?php

namespace App\Console\Commands;

use Domain\Player\Models\Player;
use Domain\Player\States\Failed;
use Domain\Player\States\Registered;
use Domain\Player\States\Scanned;
use Domain\Presence\Models\Presence;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

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
    public function handle()
    {
        $query = Presence::query()
            ->whereNotNull('joined_at')
            ->whereNotNull('left_at')
            ->whereNull('playtime_minutes');

        $bar = $this->output->createProgressBar($query->count());

        $bar->start();
        
        $query->chunkById($this->option('chunk'), function (Collection $presences) use ($bar) {
            $presences->each(function (Presence $presence) use ($bar){
                $presence->update([
                    'playtime_minutes' => (int) $presence->joined_at->diffInMinutes($presence->left_at),
                ]);
                $bar->advance();
            });
        });
        $bar->finish();
        
    }
}
