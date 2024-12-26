<?php

namespace App\Console\Commands;

use Domain\Presence\Models\DailyPlayerPresence;
use Domain\Presence\Models\Presence;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use xPaw\MinecraftQuery;
use xPaw\MinecraftQueryException;

class PlaygroundCommand extends Command
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

    protected Carbon $date;

    protected int $uniquePlayers = 0;

    /**
     * Execute the console command.
     */
    public function handle(): void
    {

        $query = new MinecraftQuery;

        try {
            $query->Connect('dev2.skyblock.net', 5235);

            print_r($query->GetInfo());
            print_r($query->GetPlayers());
        } catch (MinecraftQueryException $e) {
            echo $e->getMessage();
        }

        // $this->date = Carbon::parse($this->argument('date'));

        // $presencesOfGivenDay = Presence::query()
        //     ->where('joined_at', '>', $this->date->startOfDay())
        //     ->where('joined_at', '<', $this->date->copy()->endOfDay())
        //     ->groupBy('player_id')
        //     ->selectRaw('player_id, SUM(playtime_minutes) AS playtime_minutes')
        //     ->orderBy('player_id', 'asc')
        //     ->get();

        // $currentPlayerId = null;

        // $totalPlaytime = 0;

        // $presencesOfGivenDay->each(function (Presence $presence) use (&$currentPlayerId, &$totalPlaytime) {
        //     if ($currentPlayerId !== $presence->player_id) {

        //         $this->uniquePlayers++;
        //         $currentPlayerId = $presence->player_id;

        //         $dailyPlayerPresence =
        //         DailyPlayerPresence::create([
        //             'date' => $this->date,
        //             'player_id' => $presence->player_id,
        //             'playtime_minutes' => $totalPlaytime,
        //         ]);

        //         $totalPlaytime = 0;
        //     }

        //     $totalPlaytime += $presence->playtime_minutes;
        // });

    }
}
