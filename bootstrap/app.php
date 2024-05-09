<?php

use App\Application;
use App\Console\Commands\CalculatePlaytimeCommand;
use App\Console\Commands\NotifyPresenceSubscriptionsCommand;
use App\Console\Commands\PlaygroundCommand;
use App\Console\Commands\RegisterPlayersCommand;
use App\Console\Commands\RegisterPresencesCommand;
use App\Console\Commands\Tmp\SplitPresencesPerDayCommand;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->withCommands([
        __DIR__.'/../src/App/Console/Commands',
        RegisterPresencesCommand::class,
        RegisterPlayersCommand::class,
        CalculatePlaytimeCommand::class,
        SplitPresencesPerDayCommand::class,
        NotifyPresenceSubscriptionsCommand::class,
        PlaygroundCommand::class,
    ])
    ->create();
