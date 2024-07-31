<?php

use App\Console\Commands\RegisterPlayersCommand;
use App\Console\Commands\ScanSkyblockServerCommand;
use Illuminate\Support\Facades\Schedule;

Schedule::command(ScanSkyblockServerCommand::class)->everyMinute();
Schedule::command(RegisterPlayersCommand::class)->everyThreeMinutes();
