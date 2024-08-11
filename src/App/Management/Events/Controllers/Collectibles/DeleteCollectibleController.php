<?php

namespace App\Management\Events\Controllers\Collectibles;

use Domain\Event\Actions\Collectibles\DeleteCollectibleAction;
use Domain\Event\Models\Collectible;
use Exception;

class DeleteCollectibleController
{
    public function __invoke(Collectible $collectible, DeleteCollectibleAction $action)
    {
        try {
            $action->execute($collectible);
        } catch (Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }

        return redirect()->route('management.events.index');
    }
}
