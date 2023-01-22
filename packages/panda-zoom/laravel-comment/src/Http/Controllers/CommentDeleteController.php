<?php

namespace PandaZoom\LaravelComment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use PandaZoom\LaravelComment\Contracts\DeleteCommentActionContract;
use PandaZoom\LaravelComment\Models\Comment;
use function app;
use function response;
use function class_exists;

class_exists(Comment::class);

class CommentDeleteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function __invoke(Comment $comment, DeleteCommentActionContract $action): JsonResponse
    {
        $this->authorize('delete', $comment);

        app('db')->transaction(static fn () => $action->run($comment, true));

        return response()->json([]);
    }
}
