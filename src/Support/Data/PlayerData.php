<?php

namespace Support\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class PlayerData extends Data
{
    public function __construct(
        public ?int $id,
        public string $name,
    ) {}
}
