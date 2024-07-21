<?php

namespace Support\Skyblock\ServerStatusApi;

use Illuminate\Support\Facades\Http;
use Support\Data\ServerStatusData;
use Support\Skyblock\Enums\SkyblockServerListEnum;

class Client
{
    protected ServerStatusData $serverStatusData;

    public bool $isSuccessful = false;

    public string $errorMessage = 'No request sent';

    public function post(SkyblockServerListEnum $server): self
    {
        try {
            $response = $this->sendRequest($server);
            $this->serverStatusData = ServerStatusData::createFromSkyblockClient($response);
        } catch (\Exception $e) {
            $this->errorMessage = $e->getMessage();

            return $this;
        }

        $this->isSuccessful = true;

        return $this;
    }

    protected function sendRequest(SkyblockServerListEnum $server): array
    {
        $request = Http::asForm()
            ->acceptJson()
            ->post("https://skyblock.net/index.php?server-status/{$server->value}/query",
                [
                    '_xfResponseType' => 'json',
                    '_xfRequestUri' => '/',
                    '_xfNoRedirect' => '1',
                    'accept' => 'application/json',
                ]
            );

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
