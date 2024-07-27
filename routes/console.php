<?php

use App\Console\Commands\NotifyPresenceSubscriptionsCommand;
use App\Console\Commands\RegisterPlayersCommand;
use App\Console\Commands\RegisterPresencesCommand;
use Illuminate\Support\Facades\Schedule;

Schedule::command(RegisterPresencesCommand::class)->everyMinute();
Schedule::command(NotifyPresenceSubscriptionsCommand::class)->everyFiveMinutes();
Schedule::command(RegisterPlayersCommand::class)->everyThreeMinutes();
