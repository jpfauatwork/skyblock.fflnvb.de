<?php

namespace App\Console\Commands;

use Domain\Player\Models\Player;
use Domain\Presence\Models\Presence;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Support\Skyblock\Enums\SkyblockServerListEnum;

class RegisterPresencesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'skyblock:register-presences';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checking Server Status';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::asForm()
            ->acceptJson()
            ->post('https://skyblock.net/index.php?server-status/'.SkyblockServerListEnum::Economy->value.'/query',
                [
                    '_xfResponseType' => 'json',
                    '_xfRequestUri' => '/',
                    '_xfNoRedirect' => '1',
                ]
            );
        $jsonResponse = $response->json();

        match ($jsonResponse['serverStatus']['online']) {
            true => $this->info("Server is up with {$jsonResponse['serverStatus']['players_online']}/{$jsonResponse['serverStatus']['max_players']} Players"),
            false => $this->warn('Server is down'),
            default => $this->error('Cannot Read Info'),
        };

        $playerIds = [];

        foreach ($jsonResponse['serverStatus']['player_list'] as $playerName) {
            // Detect New Players
            // TODO: Detect renaming
            // TODO: Optimize WhereIn and map, nonmatched result in creation.
            $player = Player::firstOrCreate([
                'name' => $playerName,
            ]);

            $playerIds[] = $player->id;
        }

        $this->registerPresences($playerIds);

        $keys = [
            'serverStatus' => [
                'online' => 'bool',
                'players_online' => 'int',
                'max_players' => 'int',
                'player_list' => 'array',
            ],
        ];
    }

    private function registerPresences(array $playerIds)
    {
        $openPresences = Presence::query()
            ->whereNull('ended_at')
            ->get();

        foreach ($playerIds as $playerId) {
            $existingPlayerPresence = $openPresences->where('player_id', $playerId);

            if ($existingPlayerPresence->isNotEmpty()) {
                continue;
            }

            Presence::create([
                'player_id' => $playerId,
                'joined_at' => now(),
            ]);
        }

        $endedPresences = $openPresences->whereNotIn('player_id', $playerIds)->pluck('id');
        Presence::whereIn('id', $endedPresences)
            ->update([
                'left_at' => now(),
            ]);

    }
}
