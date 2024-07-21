<?php

namespace Domain\Player\States;

use Spatie\ModelStates\Attributes\AllowTransition;
use Spatie\ModelStates\Attributes\DefaultState;
use Spatie\ModelStates\State;

#[
    AllowTransition(Scanned::class, Registered::class),
    AllowTransition(Scanned::class, Failed::class),
    AllowTransition(Failed::class, Registered::class),
    DefaultState(Scanned::class),
]
abstract class PlayerState extends State {}
