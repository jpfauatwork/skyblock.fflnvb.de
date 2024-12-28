<?php

use App\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Infrastructure\Helpers\DiscoverCommandsHelper;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/status',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->withCommands(commands: [
        ...app(DiscoverCommandsHelper::class,
            [
                'basePath' => 'src',
                'path' => __DIR__.'/../src/App/Console/Commands',
            ]
        )->execute(),
    ])
    ->create();
