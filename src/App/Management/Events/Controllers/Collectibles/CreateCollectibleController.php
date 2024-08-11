<?php

namespace App\Management\Events\Controllers\Collectibles;

use Domain\Event\Models\Event;

class CreateCollectibleController
{
    public function __invoke(Event $event)
    {
        return view('management.event.collectibles.create', compact('event'));
    }
}
