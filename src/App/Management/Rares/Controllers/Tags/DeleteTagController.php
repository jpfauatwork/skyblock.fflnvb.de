<?php

namespace App\Management\Rares\Controllers\Tags;

use Domain\Rares\Actions\Tags\DeleteTagAction;
use Domain\Rares\Models\Tag;
use Exception;

class DeleteTagController
{
    public function __invoke(Tag $tag, DeleteTagAction $action)
    {
        try {
            $action->execute($tag);
        } catch (Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }

        return redirect()->route('management.rares.index');
    }
}
