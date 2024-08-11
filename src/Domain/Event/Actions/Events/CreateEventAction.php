<?php

namespace Domain\Event\Actions\Events;

use Domain\Event\Data\EventData;
use Domain\Event\Models\Event;
use Domain\Event\Models\EventGroup;

class CreateEventAction
{
    public function execute(EventGroup $eventGroup, EventData $data): Event
    {
        return Event::create([
            'event_group_id' => $eventGroup->id,
            'name' => $data->name,
            'description' => $data->description,
            'occured_at' => $data->occuredAt,
        ]);
    }
}
