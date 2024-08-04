<?php

namespace Domain\Server\Support\Skyblock\ServerStatusApi;

use Domain\Server\Support\Skyblock\Enums\SkyblockServerListEnum;
use Domain\Shared\Data\ServerStatusData;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class Client
{
    protected ServerStatusData $serverStatusData;

    public bool $isSuccessful = false;

    public string $errorMessage = 'No request sent';

    public function post(SkyblockServerListEnum $server): self
    {
        try {
            $response = $this->sendRequest($server);
            $this->serverStatusData = ServerStatusData::from(Arr::get($response, 'serverStatus', []));
        } catch (Exception $e) {
            $this->errorMessage = $e->getMessage();

            return $this;
        }

        $this->errorMessage = 'No errors';
        $this->isSuccessful = true;

        return $this;
    }

    protected function sendRequest(SkyblockServerListEnum $server): array
    {
        $request = Http::asForm()
            ->acceptJson()
            ->post(
                Str::of(config('skyblock.server_status_url'))->replace('[server-id]', $server->value),
                [
                    '_xfResponseType' => 'json',
                    '_xfRequestUri' => '/',
                    '_xfNoRedirect' => '1',
                ]
            );

        logger('Status insight '.$request->status());

        return $request->json();
    }

    public function response(): ?ServerStatusData
    {
        if (! $this->isSuccessful) {
            return null;
        }

        return $this->serverStatusData;
    }
}
