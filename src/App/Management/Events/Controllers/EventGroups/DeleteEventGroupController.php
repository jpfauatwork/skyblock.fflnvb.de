<?php

namespace App\Management\Events\Controllers\EventGroups;

use Domain\Event\Actions\EventGroups\DeleteEventGroupAction;
use Domain\Event\Models\EventGroup;
use Exception;

class DeleteEventGroupController
{
    public function __invoke(EventGroup $eventGroup, DeleteEventGroupAction $action)
    {
        try {
            $action->execute($eventGroup);
        } catch (Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }

        return redirect()->route('management.events.index');
    }
}
