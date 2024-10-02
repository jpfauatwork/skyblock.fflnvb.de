<?php

namespace App\Management\Rares\Controllers;

use Domain\Rares\Models\Tag;
use Domain\Rares\Models\TagGroup;

class DashboardController
{
    public function __invoke()
    {
        $tagGroups = TagGroup::query()
            ->with('tags')
            ->orderBy('order_column', 'asc')
            ->get();

        $tags = Tag::query()
            ->withCount([
                'collectibles',
                'collectibles as collectibles_owned' => function ($query) {
                    $query->whereNotNull('collected_at');
                },
            ])
            ->with('collectibles')
            ->orderBy('occured_at', 'desc')
            ->get();

        return view('management.rares.dashboard', compact('tagGroups', 'tags'));
    }
}
