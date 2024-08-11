<?php

namespace Domain\Event\Actions\Collectibles;

use Domain\Event\Models\Collectible;

class DeleteCollectibleAction
{
    public function execute(Collectible $collectible): ?bool
    {
        return $collectible->delete();
    }
}
