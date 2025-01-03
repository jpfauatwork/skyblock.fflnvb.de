<?php

use App\PublicApi\Playground\Controllers\PlaygroundController;
use App\PublicApi\Presences\Controllers\ListPresencesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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
