<?php

namespace Domain\Server\Support\QueryProtocol\Data;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapInputName(StudlyCaseMapper::class)]
class InfoData extends Data
{
    public function __construct(
        public string $hostName,
        public string $gameType,
        public string $gameName,
        public string $version,
        public int $plugins,
        public int $map,
        public int $players,
        public int $maxPlayers,
        public int $hostPort,
        public string $hostIp,
        public string $rawPlugins,
        public string $software,
    ) {}
}
