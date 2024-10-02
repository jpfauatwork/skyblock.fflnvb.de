<?php

namespace App\Management\Rares\Controllers\Collectibles;

use App\Management\Rares\Requests\StoreCollectibleRequest;
use Domain\Rares\Actions\Collectibles\CreateCollectibleAction;
use Domain\Rares\Data\CollectibleData;
use Domain\Rares\Models\Tag;
use Exception;

class StoreCollectibleController
{
    public function __invoke(Tag $tag, StoreCollectibleRequest $request, CreateCollectibleAction $action)
    {
        try {
            $collectibleData = CollectibleData::from($request->validated());
            $action->execute($tag, $collectibleData);
        } catch (Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }

        return redirect()->route('management.rares.index');
    }
}
