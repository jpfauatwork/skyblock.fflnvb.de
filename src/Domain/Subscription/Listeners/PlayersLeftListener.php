<?php

namespace Domain\Subscription\Listeners;

use Domain\Shared\Events\PlayersLeftEvent;
use Domain\Subscription\Jobs\AssessSubscriptionsJob;

class PlayersLeftListener
{
    public function handle(PlayersLeftEvent $event): void
    {
        AssessSubscriptionsJob::dispatch($event->presenceDataCollection);
    }
}
