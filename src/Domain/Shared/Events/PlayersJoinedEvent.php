<?php

namespace Domain\Shared\Events;

use Domain\Shared\Data\PresenceData;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Support\Collection;

/**
 * @property Collection<int, PresenceData> $presenceDataCollection
 */
class PlayersJoinedEvent
{
    use Dispatchable;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public Collection $presenceDataCollection,
    ) {}
}
