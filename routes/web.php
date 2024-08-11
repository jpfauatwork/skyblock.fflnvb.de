<?php

use App\Management\Events\Controllers\Collectibles\CreateCollectibleController;
use App\Management\Events\Controllers\Collectibles\DeleteCollectibleController;
use App\Management\Events\Controllers\Collectibles\StoreCollectibleController;
use App\Management\Events\Controllers\DashboardController;
use App\Management\Events\Controllers\EventGroups\CreateEventGroupController;
use App\Management\Events\Controllers\EventGroups\DeleteEventGroupController;
use App\Management\Events\Controllers\EventGroups\StoreEventGroupController;
use App\Management\Events\Controllers\Events\CreateEventController;
use App\Management\Events\Controllers\Events\DeleteEventController;
use App\Management\Events\Controllers\Events\StoreEventController;
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
                Route::prefix('groups')
                    ->name('groups.')
                    ->group(function () {
                        Route::get('create', CreateEventGroupController::class)->name('create');
                        Route::post('store', StoreEventGroupController::class)->name('store');
                        Route::delete('{eventGroup}', DeleteEventGroupController::class)->name('delete');
                    });
                Route::prefix('events')
                    ->name('events.')
                    ->group(function () {
                        Route::get('{eventGroup}/create', CreateEventController::class)->name('create');
                        Route::post('{eventGroup}/store', StoreEventController::class)->name('store');
                        Route::delete('{event}', DeleteEventController::class)->name('delete');
                    });
                Route::prefix('collectibles')
                    ->name('collectibles.')
                    ->group(function () {
                        Route::get('{event}/create', CreateCollectibleController::class)->name('create');
                        Route::post('{event}/store', StoreCollectibleController::class)->name('store');
                        Route::delete('{collectible}', DeleteCollectibleController::class)->name('delete');
                    });
            });
    });
