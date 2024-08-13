<?php

namespace Domain\Rares\Actions\EventGroups;

use Domain\Rares\Data\EventGroupData;
use Domain\Rares\Models\EventGroup;

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
