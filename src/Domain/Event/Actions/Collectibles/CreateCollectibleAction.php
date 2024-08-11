<?php

namespace Domain\Event\Actions\Collectibles;

use Domain\Event\Data\CollectibleData;
use Domain\Event\Models\Collectible;
use Domain\Event\Models\Event;

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
