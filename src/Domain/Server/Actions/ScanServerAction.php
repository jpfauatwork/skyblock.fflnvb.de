<?php

namespace Domain\Server\Actions;

use Domain\Server\Support\Enums\Server;
use Domain\Server\Support\QueryProtocol\Client;
use Domain\Shared\Data\ServerStatusData;
use Domain\Shared\Events\ServerScannedEvent;
use Exception;

class ScanServerAction
{
    protected ServerStatusData $serverStatusData;

    public function execute(Server $server): void
    {
        $this->getPlayerList($server);
        $this->dispatchEvent();
    }

    protected function getPlayerList(Server $server): void
    {
        $serverStatusRequest = app(Client::class)->connect($server);

        if (! $serverStatusRequest->isSuccessful) {
            logger('Request failed: '.$serverStatusRequest->status);
            throw new Exception('Request failed: '.$serverStatusRequest->status);
        }

        $this->serverStatusData = $serverStatusRequest->response();
    }

    protected function dispatchEvent()
    {
        ServerScannedEvent::dispatch($this->serverStatusData);
    }
}
