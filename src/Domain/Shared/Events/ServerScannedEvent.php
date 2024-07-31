<?php

namespace Domain\Shared\Events;

use Domain\Shared\Data\ServerStatusData;
use Illuminate\Foundation\Events\Dispatchable;

class ServerScannedEvent
{
    use Dispatchable;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public ServerStatusData $serverStatusData,
    ) {}
}
