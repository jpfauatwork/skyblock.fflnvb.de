<?php

use App\PublicApi\Presences\Controllers\ListPresencesController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/public-api/presences');

Route::prefix('public-api')
    ->name('public-api.')
    ->middleware([])
    ->group(function () {
        Route::prefix('presences')
            ->name('presences.')
            ->group(function () {
                Route::get('/', ListPresencesController::class)->name('list');
            });
    });
