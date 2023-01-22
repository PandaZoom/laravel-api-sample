<?php

use Illuminate\Support\Facades\Route;
use PandaZoom\LaravelComment\Http\Controllers\CommentController;
use PandaZoom\LaravelComment\Http\Controllers\CommentDeleteController;
use PandaZoom\LaravelComment\Http\Controllers\CommentRestoreController;

Route::apiResource('articles.comments', CommentController::class)
    ->names([
        'index' => 'api.articles.comments.index',
        'store' => 'api.articles.comments.store',
        'show' => 'api.comments.show',
        'update' => 'api.comments.update',
        'destroy' => 'api.comments.destroy',
    ])->shallow();

Route::post('comments/{comment}/restore', CommentRestoreController::class)
    ->name('api.comments.restore')
    ->withTrashed();

Route::delete('comments/{comment}/delete', CommentDeleteController::class)
    ->name('api.comments.permanent_delete')
    ->withTrashed();

