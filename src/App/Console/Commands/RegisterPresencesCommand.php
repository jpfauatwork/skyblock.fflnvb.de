<?php

namespace App\Console\Commands;

use Domain\Presence\Models\Player;
use Domain\Presence\States\Player\Scanned;
use Domain\Presence\Models\Presence;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Support\Skyblock\Enums\SkyblockServerListEnum;
use Support\Skyblock\ServerStatusApi\Client;

class RegisterPresencesCommand extends Command
{
    protected Collection $playerDataCollection;

    protected EloquentCollection $activePlayers;

    protected EloquentCollection $openPresences;

    protected array $presencesToBeCreated = [];

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
        $this->getPlayerData();
        $this->createOrGetPlayers();
        $this->closeAllPresencesAtMidnight();
        $this->collectOpenPresences();
        $this->registerPresences();
        $this->closeRemainingPresences();
    }

    protected function getPlayerData(): void
    {
        $serverStatusRequest = app(Client::class)->post(SkyblockServerListEnum::Economy);

        if (! $serverStatusRequest->isSuccessful) {
            logger('Request failed: '.$serverStatusRequest->errorMessage);
            $this->error('Request failed: '.$serverStatusRequest->errorMessage);

            return;
        }

        $this->playerDataCollection = $serverStatusRequest->response()->playerList;
    }

    protected function createOrGetPlayers(): void
    {
        $this->activePlayers = Player::query()
            ->whereIn('name', $this->playerDataCollection->pluck('name'))
            ->get();

        $newPlayersToBeRegistered = $this->playerDataCollection
            ->whereNotIn('name', $this->activePlayers->pluck('name'))
            ->toArray();

        $massInsert = Arr::map($newPlayersToBeRegistered, fn (array $player) => [
            'name' => $player['name'],
            'state' => Scanned::$name,
        ]);

        Player::query()->upsert($massInsert, ['name']);

        $this->activePlayers = Player::query()
            ->whereIn('name', $this->playerDataCollection->pluck('name'))
            ->get();
    }

    protected function closeAllPresencesAtMidnight(): void
    {
        if (! now()->between(
            now()->startOfDay(),
            now()->startOfDay()->addMinutes(1)
        )) {
            return;
        }

        Presence::query()
            ->whereNull('left_at')
            ->update([
                'left_at' => now()->yesterday()->endOfDay(),
            ]);
    }

    protected function collectOpenPresences(): void
    {
        $this->openPresences = Presence::query()
            ->whereNull('left_at')
            ->get();
    }

    protected function registerPresences(): void
    {
        $this->activePlayers->each(function (Player $player) {
            $playerWasActiveOnLastCheck = $this->openPresences->where('player_id', $player->id)->count();

            if ($playerWasActiveOnLastCheck) {
                return;
            }

            $this->presencesToBeCreated[] = [
                'player_id' => $player->id,
                'joined_at' => now(),
            ];
        });

        Presence::query()->upsert($this->presencesToBeCreated, 'player_id');
    }

    protected function closeRemainingPresences(): void
    {
        $endedPresences = $this->openPresences->whereNotIn('player_id', $this->activePlayers->pluck('id'));

        Presence::query()
            ->whereIn('id', $endedPresences->pluck('id'))
            ->update([
                'left_at' => now(),
            ]);
    }
}
