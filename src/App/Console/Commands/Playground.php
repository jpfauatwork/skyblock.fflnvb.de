<?php

namespace App\Console\Commands;

use Domain\Player\Models\Player;
use Illuminate\Console\Command;

class Playground extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel:playground';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testing Stuff';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $unregisteredPlayers1 = Player::query()
            ->whereNot
            ->registered()
            ->get();

        $unregisteredPlayers2 = Player::query()
            ->whereNot(function ($query) {
                $query->registered();
            })
            ->get();

        $this->info("Unregistered Players: {$unregisteredPlayers1->count()}");
        $this->info("Unregistered Players: {$unregisteredPlayers2->count()}");
    }
}
