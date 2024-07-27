<?php

namespace Support\Skyblock\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ServerStatusData extends Data
{
    public function __construct(
        public bool $online = false,
        public int $playersOnline = 0,
        public ?int $maxPlayers = null,
        public array $playerList = [],
    ) {}
}
