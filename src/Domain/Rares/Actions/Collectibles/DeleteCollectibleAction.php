<?php

namespace Domain\Rares\Actions\Collectibles;

use Domain\Rares\Models\Collectible;

class DeleteCollectibleAction
{
    public function execute(Collectible $collectible): ?bool
    {
        return $collectible->delete();
    }
}
