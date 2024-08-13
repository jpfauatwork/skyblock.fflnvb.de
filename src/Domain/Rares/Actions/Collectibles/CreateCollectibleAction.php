<?php

namespace Domain\Rares\Actions\Collectibles;

use Domain\Rares\Data\CollectibleData;
use Domain\Rares\Models\Collectible;
use Domain\Rares\Models\Event;

class CreateCollectibleAction
{
    public function execute(Event $event, CollectibleData $data): Collectible
    {
        return Collectible::create([
            'event_id' => $event->id,
            'type' => $data->type,
            'name' => $data->name,
            'amount' => $data->amount,
        ]);
    }
}
