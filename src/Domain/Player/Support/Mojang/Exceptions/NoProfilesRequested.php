<?php

namespace Domain\Player\Support\Mojang\Exceptions;

use Exception;

class NoProfilesRequested extends Exception
{
    public function __construct()
    {
        parent::__construct('You requested no profiles, but the minimum is 1.');
    }
}
