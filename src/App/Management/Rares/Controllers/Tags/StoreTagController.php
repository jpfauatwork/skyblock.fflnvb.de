<?php

namespace App\Management\Rares\Controllers\Tags;

use App\Management\Rares\Requests\StoreTagRequest;
use Domain\Rares\Actions\Tags\CreateTagAction;
use Domain\Rares\Data\TagData;
use Domain\Rares\Models\TagGroup;
use Exception;

class StoreTagController
{
    public function __invoke(TagGroup $tagGroup, StoreTagRequest $request, CreateTagAction $action)
    {
        try {
            $tagData = TagData::from($request->validated());
            $action->execute($tagGroup, $tagData);
        } catch (Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }

        return redirect()->route('management.rares.index');
    }
}
