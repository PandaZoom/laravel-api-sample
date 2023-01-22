<?php

use Illuminate\Support\Facades\Route;
use PandaZoom\LaravelLanguage\Http\Controllers\LanguageController;
use PandaZoom\LaravelLanguage\Http\Controllers\LanguagePatchController;

Route::get('languages', LanguageController::class)
    ->name('api.languages.index');

Route::patch('languages/{language}', LanguagePatchController::class)
    ->name('api.languages.patch');
