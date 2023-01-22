<?php

use Illuminate\Support\Facades\Route;
use PandaZoom\LaravelUser\Http\Controllers\ProfileController;
use PandaZoom\LaravelUser\Http\Controllers\ProfilePatchController;
use PandaZoom\LaravelUser\Http\Controllers\ProfileDeleteController;
use PandaZoom\LaravelUser\Http\Controllers\UserController;
use PandaZoom\LaravelUser\Http\Controllers\UserDeleteController;
use PandaZoom\LaravelUser\Http\Controllers\UserEmailExistController;
use PandaZoom\LaravelUser\Http\Controllers\UserPatchController;
use PandaZoom\LaravelUser\Http\Controllers\UserRestoreController;

Route::get('profile', [ProfileController::class, 'show'])
    ->name('api.profile.show');

Route::put('profile', [ProfileController::class, 'update'])
    ->name('api.profile.update');

Route::patch('profile', ProfilePatchController::class)
    ->name('api.profile.patch');

Route::delete('profile', [ProfileController::class, 'destroy'])
    ->name('api.profile.destroy');

Route::delete('profile', ProfileDeleteController::class)
    ->name('api.profile.permanent_delete');

Route::apiResource('users', UserController::class)
    ->only(['index', 'show', 'update', 'destroy'])
    ->names([
        'index' => 'api.users.index',
        'show' => 'api.users.show',
        'update' => 'api.users.update',
        'destroy' => 'api.users.destroy',
    ]);

Route::patch('users/{user}', UserPatchController::class)
    ->name('api.users.patch');

Route::post('users/{user}/restore', UserRestoreController::class)
    ->name('api.users.restore')
    ->withTrashed();

Route::delete('users/{user}/delete', UserDeleteController::class)
    ->name('api.users.permanent_delete')
    ->withTrashed();

Route::post('user-emails/exists', UserEmailExistController::class)
    ->name('api.user_email.is_exists')
    ->withTrashed();
