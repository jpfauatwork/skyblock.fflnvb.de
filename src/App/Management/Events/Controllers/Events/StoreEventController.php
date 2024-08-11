<?php

namespace App\Management\Events\Controllers\Events;

use App\Management\Events\Requests\StoreEventRequest;
use Domain\Event\Actions\Events\CreateEventAction;
use Domain\Event\Data\EventData;
use Domain\Event\Models\EventGroup;
use Exception;

class StoreEventController
{
    public function __invoke(EventGroup $eventGroup, StoreEventRequest $request, CreateEventAction $action)
    {
        try {
            $eventData = EventData::from($request->validated());
            $action->execute($eventGroup, $eventData);
        } catch (Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }

        return redirect()->route('management.events.index');
    }
}
