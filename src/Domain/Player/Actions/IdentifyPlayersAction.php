<?php

namespace Domain\Player\Actions;

use Domain\Player\Events\NewPlayersDetectedEvent;
use Domain\Player\Models\Player;
use Domain\Shared\Data\PlayerData;
use Domain\Shared\Events\PlayersIdentifiedEvent;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

/**
 * @property Collection<int, string> $names
 * @property EloquentCollection<int, Player> $identifiedPlayers
 */
class IdentifyPlayersAction
{
    public function execute(Collection $names): void
    {
        $this->names = $names;
        $this->findExistingPlayers();
        $this->registerNewPlayers();
    }

    protected function findExistingPlayers(): void
    {
        $this->identifiedPlayers = Player::query()
            ->whereIn('name', $this->names)
            ->get();

        PlayersIdentifiedEvent::dispatch(PlayerData::collect($this->identifiedPlayers, Collection::class));
    }

    protected function registerNewPlayers(): void
    {
        $newPlayerNames = $this->names->diff($this->identifiedPlayers->pluck('name'));

        NewPlayersDetectedEvent::dispatch($newPlayerNames);
    }
}
