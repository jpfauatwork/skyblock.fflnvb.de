<?php

namespace Domain\Player\Listeners;

use Domain\Player\Events\NewPlayersDetectedEvent;
use Domain\Player\Jobs\RegisterPlayersJob;

class NewPlayersDetectedListener
{
    public function handle(NewPlayersDetectedEvent $event): void
    {
        RegisterPlayersJob::dispatch($event->names);
    }
}
