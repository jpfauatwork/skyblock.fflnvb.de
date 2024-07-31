<?php

namespace Domain\Presence\Listeners;

use Domain\Presence\Jobs\AssociatePlayersToNamesJob;
use Domain\Shared\Events\PlayersIdentifiedEvent;

class PlayersIdentifiedListener
{
    public function handle(PlayersIdentifiedEvent $event): void
    {
        AssociatePlayersToNamesJob::dispatch($event->playerDataCollection);
    }
}
