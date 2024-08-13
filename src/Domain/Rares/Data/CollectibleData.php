<?php

namespace Domain\Rares\Data;

use Domain\Rares\Enums\CollectibleTypeEnum;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class CollectibleData extends Data
{
    public function __construct(
        public CollectibleTypeEnum $type,
        public string $name,
        public ?int $amount = null,
    ) {}
}
