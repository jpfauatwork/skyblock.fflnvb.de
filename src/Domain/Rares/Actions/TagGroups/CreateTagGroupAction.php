<?php

namespace Domain\Rares\Actions\TagGroups;

use Domain\Rares\Data\TagGroupData;
use Domain\Rares\Models\TagGroup;

class CreateTagGroupAction
{
    public function execute(TagGroupData $data): TagGroup
    {
        return TagGroup::create([
            'name' => $data->name,
            'description' => $data->description,
            'order_column' => $data->orderColumn,
        ]);
    }
}
