<?php

namespace Domain\Presence\Actions;

use Domain\Presence\Models\Player;
use Domain\Presence\Models\Presence;
use Domain\Presence\States\Player\Scanned;
use Exception;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Support\Skyblock\Enums\SkyblockServerListEnum;
use Support\Skyblock\ServerStatusApi\Client;

class RegisterPresencesAction
{
    protected Collection $playerDataCollection;

    protected EloquentCollection $activePlayers;

    protected EloquentCollection $openPresences;

    protected array $presencesToBeCreated = [];

    public function execute()
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
            throw new Exception('Request failed: '.$serverStatusRequest->errorMessage);

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
