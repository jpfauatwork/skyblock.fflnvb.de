<?php

namespace App\Management\Rares\Controllers\TagGroups;

use Domain\Rares\Actions\TagGroups\DeleteTagGroupAction;
use Domain\Rares\Models\TagGroup;
use Exception;

class DeleteTagGroupController
{
    public function __invoke(TagGroup $tagGroup, DeleteTagGroupAction $action)
    {
        try {
            $action->execute($tagGroup);
        } catch (Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }

        return redirect()->route('management.rares.index');
    }
}
