<?php

namespace Domain\Rares\Actions\Tags;

use Domain\Rares\Models\Tag;
use Exception;

class DeleteTagAction
{
    public function execute(Tag $tag): ?bool
    {
        if ($tag->collectibles->isNotEmpty()) {
            throw new Exception('tag must have no collectibles attached to be deleted');
        }

        return $tag->delete();
    }
}
