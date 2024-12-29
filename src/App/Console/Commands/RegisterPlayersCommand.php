<?php

namespace App\Console\Commands;

use Domain\Player\Events\NewPlayersDetectedEvent;
use Domain\Presence\Models\Presence;
use Illuminate\Console\Command;

class RegisterPlayersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'players:register';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reattempt registering players';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $unregisteredPlayers = Presence::query()
            ->whereNull('player_id')
            ->where('created_at', '>', now()->subMinutes(10))
            ->where('created_at', '<', now()->subDay())
            ->pluck('name')
            ->unique();

        NewPlayersDetectedEvent::dispatch($unregisteredPlayers);
    }
}
