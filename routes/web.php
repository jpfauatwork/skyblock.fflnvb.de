<?php

use App\Management\Events\Controllers\DashboardController;
use App\PublicApi\Playground\Controllers\PlaygroundController;
use App\PublicApi\Presences\Controllers\ListPresencesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/presences/recent', '/public-api/presences');

Route::prefix('public-api')
    ->name('public-api.')
    ->middleware([])
    ->group(function () {
        Route::get('/playground', PlaygroundController::class);
        Route::prefix('presences')
            ->name('presences.')
            ->group(function () {
                Route::get('/', ListPresencesController::class)->name('list');
            });
    });

Route::prefix('management')
    ->name('management.')
    ->middleware([
        'auth.basic',
    ])
    ->group(function () {
        Route::prefix('events')
            ->name('events.')
            ->group(function () {
                Route::get('/', DashboardController::class)->name('index');
            });
    });
