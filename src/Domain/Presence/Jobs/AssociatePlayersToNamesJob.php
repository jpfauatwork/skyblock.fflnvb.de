<?php

namespace Domain\Presence\Jobs;

use Domain\Presence\Actions\AssociatePlayersToNamesAction;
use Domain\Shared\Data\PlayerData;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Collection;

/**
 * @property Collection<int, PlayerData> $playerDataCollection
 */
class AssociatePlayersToNamesJob implements ShouldQueue
{
    use Queueable;

    /**
     * @param  Collection<int, PlayerData>  $playerDataCollection
     */
    public function __construct(
        public Collection $playerDataCollection,
    ) {}

    public function handle(): void
    {
        app(AssociatePlayersToNamesAction::class)->execute($this->playerDataCollection);
    }
}
