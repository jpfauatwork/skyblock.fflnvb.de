<?php

namespace App\Management\Events\Controllers\Collectibles;

use Domain\Rares\Models\Event;

class CreateCollectibleController
{
    public function __invoke(Event $event)
    {
        return view('management.rares.collectibles.create', compact('event'));
    }
}
