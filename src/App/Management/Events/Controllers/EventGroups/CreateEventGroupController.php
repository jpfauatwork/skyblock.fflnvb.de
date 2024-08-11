<?php

namespace App\Management\Events\Controllers\EventGroups;

class CreateEventGroupController
{
    public function __invoke()
    {
        return view('management.event.groups.create');
    }
}
