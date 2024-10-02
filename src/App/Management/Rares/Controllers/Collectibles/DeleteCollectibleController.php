<?php

namespace App\Management\Rares\Controllers\Collectibles;

use Domain\Rares\Actions\Collectibles\DeleteCollectibleAction;
use Domain\Rares\Models\Collectible;
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

        return redirect()->route('management.rares.index');
    }
}
