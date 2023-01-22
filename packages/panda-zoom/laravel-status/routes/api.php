<?php

use Illuminate\Support\Facades\Route;
use PandaZoom\LaravelStatus\Http\Controllers\StatusController;
use PandaZoom\LaravelStatus\Http\Controllers\StatusRestoreController;

Route::apiResource('statuses', StatusController::class)
    ->names([
        'index' => 'api.statuses.index',
        'show' => 'api.statuses.show',
        'store' => 'api.statuses.store',
        'update' => 'api.statuses.update',
        'destroy' => 'api.statuses.destroy',
    ]);

Route::post('statuses/{status}/restore', StatusRestoreController::class)
    ->name('api.statuses.restore')
    ->withTrashed();

