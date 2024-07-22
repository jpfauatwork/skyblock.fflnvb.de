<?php

use App\Console\Commands\NotifyPresenceSubscriptionsCommand;
use App\Console\Commands\RegisterPlayersCommand;
use App\Console\Commands\RegisterPresencesCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command(RegisterPresencesCommand::class)->everyMinute();
Schedule::command(NotifyPresenceSubscriptionsCommand::class)->everyFiveMinutes();
Schedule::command(RegisterPlayersCommand::class)->everyThreeMinutes();
