<?php

namespace Domain\Server\Support\Enums;

use Domain\Server\Support\Enums\Attributes\ServerAttributes;
use Domain\Server\Support\Enums\Concerns\WithServerAttributes;

enum Server
{
    use WithServerAttributes;

    #[ServerAttributes('dev2.skyblock.net', 5235)]
    case SkyblockEconomy;
}
