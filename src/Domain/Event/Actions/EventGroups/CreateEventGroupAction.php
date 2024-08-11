<?php

namespace Domain\Event\Actions\EventGroups;

use Domain\Event\Data\EventGroupData;
use Domain\Event\Models\EventGroup;

class CreateEventGroupAction
{
    public function execute(EventGroupData $data): EventGroup
    {
        return EventGroup::create([
            'name' => $data->name,
            'description' => $data->description,
            'order_column' => $data->orderColumn,
        ]);
    }
}
