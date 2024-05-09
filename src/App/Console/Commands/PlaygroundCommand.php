<?php

namespace App\Console\Commands;

use Domain\Presence\Models\Presence;
use Illuminate\Console\Command;


class PlaygroundCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel:playground {--date=2024-05-07: The Date to filter Presences by}';

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
        $uniquePlayers = Presence::query()
            ->whereDate('joined_at', $this->option('date'))
            ->groupBy('player_id')->count();

        $this->info("Unique Players: {$uniquePlayers}");
    }
}
