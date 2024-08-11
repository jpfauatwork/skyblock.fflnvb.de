<?php

namespace App\Management\Events\Controllers\Events;

use Domain\Event\Models\EventGroup;

class CreateEventController
{
    public function __invoke(EventGroup $eventGroup)
    {
        return view('management.event.events.create', compact('eventGroup'));
    }
}
