<?php

use App\Console\Commands\ScanSkyblockServerCommand;
use Illuminate\Support\Facades\Schedule;

if (env('SKYBLOCK_SERVER_SCAN_ENABLED', false)) {
    Schedule::command(ScanSkyblockServerCommand::class, ['economy'])->everyMinute();
}
