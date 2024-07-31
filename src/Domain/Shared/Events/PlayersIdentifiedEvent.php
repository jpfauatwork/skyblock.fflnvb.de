<?php

namespace Domain\Shared\Events;

use Domain\Shared\Data\PlayerData;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Support\Collection;

/**
 * @property Collection<int, PlayerData> $playerDataCollection
 */
class PlayersIdentifiedEvent
{
    use Dispatchable;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public Collection $playerDataCollection,
    ) {}
}
