<?php

namespace App\Management\Events\Controllers\EventGroups;

use Domain\Rares\Actions\EventGroups\DeleteEventGroupAction;
use Domain\Rares\Models\EventGroup;
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

        return redirect()->route('management.rares.index');
    }
}
