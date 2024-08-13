<?php

namespace Domain\Rares\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class EventGroupData extends Data
{
    public function __construct(
        public string $name,
        public ?string $description = null,
        public ?string $orderColumn = null,
    ) {}
}
