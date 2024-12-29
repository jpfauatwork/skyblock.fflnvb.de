<?php

namespace Domain\Presence\Listeners;

use Domain\Presence\Jobs\AssessPresencesJob;
use Domain\Shared\Events\ServerScannedEvent;

class ServerScannedListener
{
    public function handle(ServerScannedEvent $event): void
    {
        AssessPresencesJob::dispatch($event->serverStatusData->players);
    }
}
