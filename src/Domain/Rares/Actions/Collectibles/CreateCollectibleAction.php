<?php

namespace Domain\Rares\Actions\Collectibles;

use Domain\Rares\Data\CollectibleData;
use Domain\Rares\Models\Collectible;
use Domain\Rares\Models\Tag;

class CreateCollectibleAction
{
    public function execute(Tag $tag, CollectibleData $data): Collectible
    {
        return Collectible::create([
            'tag_id' => $tag->id,
            'type' => $data->type,
            'name' => $data->name,
            'amount' => $data->amount,
        ]);
    }
}
