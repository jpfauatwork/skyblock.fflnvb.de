<?php

namespace App\Management\Events\Controllers\Collectibles;

use App\Management\Events\Requests\StoreCollectibleRequest;
use Domain\Event\Actions\Collectibles\CreateCollectibleAction;
use Domain\Event\Data\CollectibleData;
use Domain\Event\Models\Event;
use Exception;

class StoreCollectibleController
{
    public function __invoke(Event $event, StoreCollectibleRequest $request, CreateCollectibleAction $action)
    {
        try {
            $collectibleData = CollectibleData::from($request->validated());
            $action->execute($event, $collectibleData);
        } catch (Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }

        return redirect()->route('management.events.index');
    }
}
