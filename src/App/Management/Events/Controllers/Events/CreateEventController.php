<?php

namespace App\Management\Events\Controllers\Events;

use Domain\Rares\Models\EventGroup;

class CreateEventController
{
    public function __invoke(EventGroup $eventGroup)
    {
        return view('management.rares.events.create', compact('eventGroup'));
    }
}
