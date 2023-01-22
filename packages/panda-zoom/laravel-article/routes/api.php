<?php

use Illuminate\Support\Facades\Route;
use PandaZoom\LaravelArticle\Http\Controllers\ArticleController;
use PandaZoom\LaravelArticle\Http\Controllers\ArticleDeleteController;
use PandaZoom\LaravelArticle\Http\Controllers\ArticlePatchController;
use PandaZoom\LaravelArticle\Http\Controllers\ArticleRestoreController;

Route::apiResource('articles', ArticleController::class)
    ->names([
        'index' => 'api.articles.index',
        'show' => 'api.articles.show',
        'store' => 'api.articles.store',
        'update' => 'api.articles.update',
        'destroy' => 'api.articles.destroy',
    ]);

Route::patch('articles/{article}', ArticlePatchController::class)
    ->name('api.articles.patch');

Route::post('articles/{article}/restore', ArticleRestoreController::class)
    ->name('api.articles.restore')
    ->withTrashed();

Route::delete('articles/{article}/delete', ArticleDeleteController::class)
    ->name('api.articles.permanent_delete')
    ->withTrashed();

