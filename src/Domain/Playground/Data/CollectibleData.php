<?php

namespace Domain\Playground\Data;

use Domain\Playground\Enums\CollectibleTypes;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class CollectibleData extends Data
{
    public function __construct(
        public CollectibleTypes $type,
        public string $lore,
        public int $amount,
    ) {}
}