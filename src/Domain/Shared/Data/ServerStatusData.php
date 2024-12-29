<?php

namespace Domain\Shared\Data;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class ServerStatusData extends Data
{
    public function __construct(
        public bool $online,
        public ?int $players_online,
        public ?int $max_players,
        public Collection $players,
    ) {}
}
