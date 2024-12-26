<?php

namespace Domain\Server\Support\QueryProtocol;

use Domain\Server\Support\Enums\Server;
use Domain\Shared\Data\ServerStatusData;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use xPaw\MinecraftQuery;
use xPaw\MinecraftQueryException;

class Client
{
    protected ServerStatusData $serverStatusData;

    public bool $isSuccessful = false;

    public string $errorMessage = 'No request sent';

    private MinecraftQuery $connection;

    public function connect(Server $server): self
    {
        $this->connection = new MinecraftQuery;

        try {
            $this->connection->Connect('dev2.skyblock.net', 5235);
        } catch (MinecraftQueryException $e) {
            $this->errorMessage = $e->getMessage();
        }
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

    protected function sendRequest(Server $server): array
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

        logger('Status insight '.$request->status(), ['reason' => $request->reason(), 'headers' => $request->headers(), 'body' => $request->body()]);

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
