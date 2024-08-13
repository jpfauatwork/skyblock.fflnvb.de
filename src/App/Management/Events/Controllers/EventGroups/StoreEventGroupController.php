<?php

namespace App\Management\Events\Controllers\EventGroups;

use App\Management\Events\Requests\StoreEventGroupRequest;
use Domain\Rares\Actions\EventGroups\CreateEventGroupAction;
use Domain\Rares\Data\EventGroupData;
use Exception;

class StoreEventGroupController
{
    public function __invoke(StoreEventGroupRequest $request, CreateEventGroupAction $action)
    {
        try {
            $eventGroupData = EventGroupData::from($request->validated());
            $action->execute($eventGroupData);
        } catch (Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }

        return redirect()->route('management.rares.index');
    }
}
