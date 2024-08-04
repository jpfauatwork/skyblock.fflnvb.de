<?php

use App\Console\Commands\ScanSkyblockServerCommand;
use Illuminate\Support\Facades\Schedule;

Schedule::command(ScanSkyblockServerCommand::class, ['server' => 'economy'])->everyMinute();
