<?php

namespace Domain\Shared\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class PresenceData extends Data
{
    public function __construct(
        public string $name,
        public string $joinedAt,
        public ?int $playerId = null,
        public ?string $leftAt = null,
    ) {}
}
