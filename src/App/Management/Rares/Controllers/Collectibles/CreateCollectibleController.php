<?php

namespace App\Management\Rares\Controllers\Collectibles;

use Domain\Rares\Models\Tag;

class CreateCollectibleController
{
    public function __invoke(Tag $tag)
    {
        return view('management.rares.collectibles.create', compact('tag'));
    }
}
