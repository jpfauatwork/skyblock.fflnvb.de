<?php

namespace App\Management\Events\Controllers\Events;

use Domain\Event\Actions\Events\DeleteEventAction;
use Domain\Event\Models\Event;
use Exception;

class DeleteEventController
{
    public function __invoke(Event $event, DeleteEventAction $action)
    {
        try {
            $action->execute($event);
        } catch (Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }

        return redirect()->route('management.events.index');
    }
}
