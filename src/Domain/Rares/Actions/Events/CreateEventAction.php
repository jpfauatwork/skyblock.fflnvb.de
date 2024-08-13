<?php

namespace Domain\Rares\Actions\Events;

use Domain\Rares\Data\EventData;
use Domain\Rares\Models\Event;
use Domain\Rares\Models\EventGroup;

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
