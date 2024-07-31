<?php

namespace Domain\Player\Support\Mojang\Data;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ProfileData extends Data
{
    public function __construct(
        #[MapInputName('id')]
        public ?string $mojangId,
        public string $name,
    ) {}
}
