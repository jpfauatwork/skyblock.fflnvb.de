<?php

namespace Domain\Playground\Data;

use DateTime;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class DropPartyData extends Data
{
    public function __construct(
        public string $name,
        public DateTime $date,
        /** @var Collection<int, CollectibleData> */
        public Collection $collectibles,
    ) {}
}
