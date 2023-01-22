<?php

namespace PandaZoom\LaravelComment\Http\Controllers;

use App\Http\Controllers\Controller;
use PandaZoom\LaravelComment\Contracts\RestoreCommentActionContract;
use PandaZoom\LaravelComment\Http\Resources\CommentResource;
use PandaZoom\LaravelComment\Models\Comment;
use function app;

class CommentRestoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function __invoke(Comment $comment, RestoreCommentActionContract $action): CommentResource
    {
        $this->authorize('update', $comment);

        app('db')->transaction(static fn () => $action->run($comment));

        return new CommentResource($comment);
    }
}
