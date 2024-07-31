<?php

namespace Domain\Server\Actions;

use Domain\Server\Support\Skyblock\Enums\SkyblockServerListEnum;
use Domain\Server\Support\Skyblock\ServerStatusApi\Client;
use Domain\Shared\Data\ServerStatusData;
use Domain\Shared\Events\ServerScannedEvent;
use Exception;

class ScanServerAction
{
    protected ServerStatusData $serverStatusData;

    public function execute(SkyblockServerListEnum $server): void
    {
        $this->getPlayerList($server);
        $this->dispatchEvent();
    }

    protected function getPlayerList(SkyblockServerListEnum $server): void
    {
        $serverStatusRequest = app(Client::class)->post($server);

        if (! $serverStatusRequest->isSuccessful) {
            logger('Request failed: '.$serverStatusRequest->errorMessage);
            throw new Exception('Request failed: '.$serverStatusRequest->errorMessage);
        }

        $this->serverStatusData = $serverStatusRequest->response();
    }

    protected function dispatchEvent()
    {
        ServerScannedEvent::dispatch($this->serverStatusData);
    }
}
