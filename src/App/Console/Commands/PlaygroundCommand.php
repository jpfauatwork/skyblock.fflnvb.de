<?php

namespace App\Console\Commands;

use Domain\Presence\Models\Presence;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

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

    protected Carbon $date;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->date = Carbon::parse($this->option('date'));
        $uniquePlayers = Presence::query()
            ->where('joined_at', '<', $this->date->startOfDay())
            ->where('joined_at', '>', $this->date->endOfDay())
            ->groupBy('player_id')->count();

        $this->info("Unique Players: {$uniquePlayers}");
    }
}
