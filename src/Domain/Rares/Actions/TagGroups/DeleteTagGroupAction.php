<?php

namespace Domain\Rares\Actions\TagGroups;

use Domain\Rares\Models\TagGroup;
use Exception;

class DeleteTagGroupAction
{
    public function execute(TagGroup $eventGroup): ?bool
    {
        if ($eventGroup->events->isNotEmpty()) {
            throw new Exception('Event Group must have no events to be deleted');
        }

        return $eventGroup->delete();
    }
}
