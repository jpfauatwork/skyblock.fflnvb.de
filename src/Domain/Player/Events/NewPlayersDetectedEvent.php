<?php

namespace Domain\Player\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Support\Collection;

/**
 * @property Collection<int, string> $names
 */
class NewPlayersDetectedEvent
{
    use Dispatchable;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public Collection $names,
    ) {}
}
