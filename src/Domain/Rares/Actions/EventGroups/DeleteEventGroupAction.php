<?php

namespace Domain\Rares\Actions\EventGroups;

use Domain\Rares\Models\EventGroup;
use Exception;

class DeleteEventGroupAction
{
    public function execute(EventGroup $eventGroup): ?bool
    {
        if ($eventGroup->events->isNotEmpty()) {
            throw new Exception('Event Group must have no events to be deleted');
        }

        return $eventGroup->delete();
    }
}
