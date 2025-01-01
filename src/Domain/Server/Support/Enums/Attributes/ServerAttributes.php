<?php

namespace Domain\Server\Support\Enums\Attributes;

use Attribute;

#[Attribute]
class ServerAttributes
{
    public function __construct(public string $ip, public int $port = 25565) {}
}
