<?php

use Illuminate\Support\Facades\Route;
use PandaZoom\LaravelPassportAuth\Http\Controllers\LogoutController;
use PandaZoom\LaravelPassportAuth\Http\Controllers\RegisterController;

Route::post('register', RegisterController::class)
    ->name('api.register');

Route::post('logout', LogoutController::class)
    ->name('api.logout');
