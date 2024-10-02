<?php

namespace App\Management\Rares\Controllers\Tags;

use Domain\Rares\Models\TagGroup;

class CreateTagController
{
    public function __invoke(TagGroup $tagGroup)
    {
        return view('management.rares.tags.create', compact('tagGroup'));
    }
}
