<?php

namespace Support\Mojang\Exceptions;

use Exception;

class TooManyProfilesRequested extends Exception
{
    public function __construct(int $profilesRequested)
    {
        parent::__construct("You requested $profilesRequested profiles, but the maximum is 10.");
    }
}
