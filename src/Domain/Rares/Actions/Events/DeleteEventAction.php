<?php

namespace Domain\Rares\Actions\Events;

use Domain\Rares\Models\Event;
use Exception;

class DeleteEventAction
{
    public function execute(Event $event): ?bool
    {
        if ($event->collectibles->isNotEmpty()) {
            throw new Exception('Event must have no collectibles to be deleted');
        }

        return $event->delete();
    }
}
