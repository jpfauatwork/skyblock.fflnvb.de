<?php

use App\Management\Rares\Controllers\Collectibles\CreateCollectibleController;
use App\Management\Rares\Controllers\Collectibles\DeleteCollectibleController;
use App\Management\Rares\Controllers\Collectibles\StoreCollectibleController;
use App\Management\Rares\Controllers\DashboardController;
use App\Management\Rares\Controllers\TagGroups\CreateTagGroupController;
use App\Management\Rares\Controllers\TagGroups\DeleteTagGroupController;
use App\Management\Rares\Controllers\TagGroups\StoreTagGroupController;
use App\Management\Rares\Controllers\Tags\CreateTagController;
use App\Management\Rares\Controllers\Tags\DeleteTagController;
use App\Management\Rares\Controllers\Tags\StoreTagController;
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

Route::prefix('management')
    ->name('management.')
    ->middleware([
        'auth.basic',
    ])
    ->group(function () {
        Route::prefix('rares')
            ->name('rares.')
            ->group(function () {
                Route::get('/', DashboardController::class)->name('index');
                Route::prefix('tag-groups')
                    ->name('tag-groups.')
                    ->group(function () {
                        Route::get('create', CreateTagGroupController::class)->name('create');
                        Route::post('store', StoreTagGroupController::class)->name('store');
                        Route::delete('{tagGroup}', DeleteTagGroupController::class)->name('delete');
                    });
                Route::prefix('tags')
                    ->name('tags.')
                    ->group(function () {
                        Route::get('{tagGroup}/create', CreateTagController::class)->name('create');
                        Route::post('{tagGroup}/store', StoreTagController::class)->name('store');
                        Route::delete('{tag}', DeleteTagController::class)->name('delete');
                    });
                Route::prefix('collectibles')
                    ->name('collectibles.')
                    ->group(function () {
                        Route::get('{tag}/create', CreateCollectibleController::class)->name('create');
                        Route::post('{tag}/store', StoreCollectibleController::class)->name('store');
                        Route::delete('{collectible}', DeleteCollectibleController::class)->name('delete');
                    });
            });
    });
