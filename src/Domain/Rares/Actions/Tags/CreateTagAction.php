<?php

namespace Domain\Rares\Actions\Tags;

use Domain\Rares\Data\TagData;
use Domain\Rares\Models\Tag;
use Domain\Rares\Models\TagGroup;

class CreateTagAction
{
    public function execute(TagGroup $tagGroup, TagData $data): Tag
    {
        return Tag::create([
            'tag_group_id' => $tagGroup->id,
            'name' => $data->name,
            'description' => $data->description,
            'occured_at' => $data->occuredAt,
        ]);
    }
}
