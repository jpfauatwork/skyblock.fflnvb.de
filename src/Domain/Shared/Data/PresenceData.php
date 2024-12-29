<?php

namespace Domain\Shared\Data;

use Spatie\LaravelData\Data;

class PresenceData extends Data
{
    public function __construct(
        public string $name,
        public string $joined_at,
        public ?int $player_id = null,
        public ?string $left_at = null,
    ) {}
}
