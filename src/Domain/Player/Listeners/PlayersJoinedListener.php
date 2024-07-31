<?php

namespace Domain\Player\Listeners;

use Domain\Player\Jobs\IdentifyPlayersJob;
use Domain\Shared\Events\PlayersJoinedEvent;

class PlayersJoinedListener
{
    public function handle(PlayersJoinedEvent $event): void
    {
        IdentifyPlayersJob::dispatch($event->presenceDataCollection->pluck('name'));
    }
}
