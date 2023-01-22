<?php

namespace PandaZoom\LaravelComment\Http\Controllers;

use App\Http\Controllers\Controller;
use PandaZoom\LaravelArticle\Models\Article;
use PandaZoom\LaravelBase\Services\RelationByRequest;
use PandaZoom\LaravelComment\Contracts\CreateArticleCommentActionContract;
use PandaZoom\LaravelComment\Contracts\CursorPaginateCommentActionContract;
use PandaZoom\LaravelComment\Contracts\DeleteCommentActionContract;
use PandaZoom\LaravelComment\Contracts\UpdateCommentActionContract;
use PandaZoom\LaravelComment\Http\Requests\CommentIndexRequest;
use PandaZoom\LaravelComment\Http\Requests\CommentStoreRequest;
use PandaZoom\LaravelComment\Http\Requests\CommentUpdateRequest;
use PandaZoom\LaravelComment\Http\Resources\CommentCollection;
use PandaZoom\LaravelComment\Http\Resources\CommentResource;
use PandaZoom\LaravelComment\Models\Comment;
use PandaZoom\LaravelComment\Tasks\ShowArticleTask;
use Symfony\Component\HttpFoundation\Response;
use function app;
use function class_exists;

class_exists(CommentIndexRequest::class);
class_exists(CommentUpdateRequest::class);
class_exists(CommentCollection::class);
class_exists(CommentResource::class);
class_exists(Comment::class);

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')
            ->only(['store', 'update', 'destroy']);
    }

    public function index(CommentIndexRequest $request, CursorPaginateCommentActionContract $action)
    {
        $users = $action->run($request->safe()->collect());

        return new CommentCollection($users);
    }

    public function store(CommentStoreRequest $request, Article $article, CreateArticleCommentActionContract $action)
    {
        $this->authorize('create', Comment::class);

        $comment = $action->run($article, $request->safe()->collect());

        return (new CommentResource($comment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Comment $comment): CommentResource
    {
        $this->authorize('view', $comment);

        $with = app(RelationByRequest::class)
            ->addSupportedWith(['user'])
            ->filterWith();

        if (!empty($with)) {
            $comment->load($with);
        }

        return new CommentResource($comment);
    }

    public function update(CommentUpdateRequest $request, Comment $comment, UpdateCommentActionContract $action): CommentResource
    {
        $this->authorize('update', $comment);

        app('db')->transaction(static fn() => $action->run($comment, $request->safe()->collect()));

        return new CommentResource($comment);
    }

    public function destroy(Comment $comment, DeleteCommentActionContract $action)
    {
        $this->authorize('delete', $comment);

        app('db')->transaction(static fn() => $action->run($comment));

        return response()->json([]);
    }
}
