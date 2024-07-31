<?php

namespace Domain\Presence\Actions;

use Domain\Presence\Models\Presence;
use Domain\Shared\Data\PlayerData;
use Illuminate\Support\Collection;

/**
 * @property Collection<int, PlayerData> $playerNames
 */
class AssociatePlayersToNamesAction
{
    protected Collection $playerNames;

    /**
     * @param  Collection<int, PlayerData>  $playerNames
     */
    public function execute(Collection $playerNames): void
    {
        $this->playerNames = collect($playerNames);

        $this->associatePlayersToNames();
    }

    protected function associatePlayersToNames(): void
    {
        $this->playerNames->each(function (PlayerData $playerData) {
            Presence::query()
                ->where('name', $playerData->name)
                ->whereNull('player_id')
                ->update([
                    'player_id' => $playerData->id,
                ]);
        });
    }
}
