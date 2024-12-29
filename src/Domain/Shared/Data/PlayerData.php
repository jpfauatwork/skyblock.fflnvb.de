<?php

namespace Domain\Shared\Data;

use Spatie\LaravelData\Data;

class PlayerData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
    ) {}
}
