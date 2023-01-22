<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Http\Controllers;

use App\Http\Controllers\Controller;
use PandaZoom\LaravelArticle\Contracts\CursorPaginateArticleActionContract;
use PandaZoom\LaravelArticle\Contracts\DeleteArticleActionContract;
use PandaZoom\LaravelArticle\Contracts\StoreArticleActionContract;
use PandaZoom\LaravelArticle\Contracts\UpdateArticleActionContract;
use PandaZoom\LaravelArticle\Contracts\ShowArticleActionContract;
use PandaZoom\LaravelArticle\Http\Middleware\TransformParamCamelCaseToSnakeCase;
use PandaZoom\LaravelArticle\Http\Requests\ArticleIndexRequest;
use PandaZoom\LaravelArticle\Http\Requests\ArticleStoreRequest;
use PandaZoom\LaravelArticle\Http\Requests\ArticleUpdateRequest;
use PandaZoom\LaravelArticle\Http\Resources\ArticleCollection;
use PandaZoom\LaravelArticle\Http\Resources\ArticleResource;
use PandaZoom\LaravelArticle\Models\Article;
use Symfony\Component\HttpFoundation\Response;
use function app;
use function class_exists;

class_exists(ArticleIndexRequest::class);
class_exists(ArticleUpdateRequest::class);
class_exists(ArticleCollection::class);
class_exists(ArticleResource::class);
class_exists(Article::class);

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')
            ->only(['store', 'update', 'destroy']);

        $this->middleware(TransformParamCamelCaseToSnakeCase::class)->only(['index', 'store', 'update']);
    }

    public function index(ArticleIndexRequest $request, CursorPaginateArticleActionContract $action)
    {
        $users = $action->run($request->safe()->collect());

        return new ArticleCollection($users);
    }

    public function show(Article $article, ShowArticleActionContract $action): ArticleResource
    {
        $this->authorize('view', $article);

        $action->run($article);

        return new ArticleResource($article);
    }

    public function store(ArticleStoreRequest $request, StoreArticleActionContract $action)
    {
        $this->authorize('create', Article::class);

        $article = $action->run($request->safe()->collect());

        return (new ArticleResource($article))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(ArticleUpdateRequest $request, Article $article, UpdateArticleActionContract $action): ArticleResource
    {
        $this->authorize('update', $article);

        app('db')->transaction(static fn() => $action->run($article, $request->safe()->collect()));

        return new ArticleResource($article);
    }

    public function destroy(Article $article, DeleteArticleActionContract $action)
    {
        $this->authorize('delete', $article);

        app('db')->transaction(static fn() => $action->run($article));

        return response()->json([]);
    }
}
