<?php

namespace App\Management\Events\Controllers;

use Domain\Event\Models\Event;
use Domain\Event\Models\EventGroup;

class DashboardController
{
    public function __invoke()
    {
        $eventGroups = EventGroup::query()
            ->with('events.collectibles')
            ->orderBy('order_column', 'asc')
            ->get();

        $events = Event::query()
            ->with('collectibles')
            ->orderBy('occured_at', 'desc')
            ->get();

        return view('management.event.dashboard', compact('eventGroups', 'events'));
    }
}
