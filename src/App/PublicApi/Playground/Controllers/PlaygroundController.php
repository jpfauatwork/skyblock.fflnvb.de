<?php

namespace App\PublicApi\Playground\Controllers;

use Domain\Server\Actions\ScanServerAction;
use Domain\Server\Support\Enums\Server;

class PlaygroundController
{
    public function __invoke()
    {
        app(ScanServerAction::class)->execute(Server::SkyblockEconomy);
    }
}
