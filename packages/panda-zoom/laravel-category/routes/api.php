<?php

use Illuminate\Support\Facades\Route;
use PandaZoom\LaravelCategory\Http\Controllers\CategoryController;
use PandaZoom\LaravelCategory\Http\Controllers\CategoryPatchController;
use PandaZoom\LaravelCategory\Http\Controllers\CategoryRestoreController;

Route::apiResource('categories', CategoryController::class)
    ->names([
        'index' => 'api.categories.index',
        'store' => 'api.categories.store',
        'show' => 'api.categories.show',
        'update' => 'api.categories.update',
        'destroy' => 'api.categories.destroy',
    ]);

Route::patch('categories/{category}', CategoryPatchController::class)
    ->name('api.categories.patch');

Route::post('categories/{category}/restore', CategoryRestoreController::class)
    ->name('api.categories.restore')
    ->withTrashed();
