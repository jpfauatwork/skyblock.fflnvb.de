<?php

namespace App\Management\Events\Controllers;

use Domain\Rares\Models\Event;
use Domain\Rares\Models\EventGroup;

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

        return view('management.rares.dashboard', compact('eventGroups', 'events'));
    }
}