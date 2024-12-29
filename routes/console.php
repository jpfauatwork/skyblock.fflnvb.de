<?php

use App\Console\Commands\RegisterPlayersCommand;
use App\Console\Commands\ScanServerCommand;
use Illuminate\Support\Facades\Schedule;

if (env('SKYBLOCK_SERVER_SCAN_ENABLED', false)) {
    Schedule::command(ScanServerCommand::class, ['skyblock-economy'])->everyMinute();
    Schedule::command(RegisterPlayersCommand::class)->everyThreeMinutes();
}
