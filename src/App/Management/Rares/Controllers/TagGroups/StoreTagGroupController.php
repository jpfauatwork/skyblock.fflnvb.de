<?php

namespace App\Management\Rares\Controllers\TagGroups;

use App\Management\Rares\Requests\StoreTagGroupRequest;
use Domain\Rares\Actions\TagGroups\CreateTagGroupAction;
use Domain\Rares\Data\TagGroupData;
use Exception;

class StoreTagGroupController
{
    public function __invoke(StoreTagGroupRequest $request, CreateTagGroupAction $action)
    {
        try {
            $tagGroupData = TagGroupData::from($request->validated());
            $action->execute($tagGroupData);
        } catch (Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }

        return redirect()->route('management.rares.index');
    }
}
