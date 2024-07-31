<?php

namespace App\PublicApi\Playground\Controllers;

use Domain\Server\Actions\ScanServerAction;
use Domain\Server\Support\Skyblock\Enums\SkyblockServerListEnum;

class PlaygroundController
{
    public function __invoke()
    {
        app(ScanServerAction::class)->execute(SkyblockServerListEnum::Economy);
    }
}
