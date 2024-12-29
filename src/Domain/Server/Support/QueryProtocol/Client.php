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

    public string $status = 'No request sent';

    private MinecraftQuery $connection;

    public function connect(Server $server): self
    {
        $this->connection = new MinecraftQuery;

        try {
            $this->connection->Connect('dev2.skyblock.net', 5235);

            $serverInfo = $this->connection->GetInfo();
            $players = $this->connection->GetPlayers();

            $this->serverStatusData = ServerStatusData::from([
                'online' => true,
                'players_online' => Arr::get($serverInfo, 'Players'),
                'max_players' => Arr::get($serverInfo, 'MaxPlayers'),
                'players' => collect($players),
            ]);
        } catch (MinecraftQueryException $e) {
            $this->status = $e->getMessage();

            return $this;
        }

        $this->status = 'Request successful';
        $this->isSuccessful = true;

        return $this;
    }

    public function response(): ?ServerStatusData
    {
        if (! $this->isSuccessful) {
            return null;
        }

        return $this->serverStatusData;
    }
}
