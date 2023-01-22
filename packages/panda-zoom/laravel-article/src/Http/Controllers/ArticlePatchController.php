<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Http\Controllers;

use App\Http\Controllers\Controller;
use PandaZoom\LaravelArticle\Contracts\PatchArticleActionContract;
use PandaZoom\LaravelArticle\Http\Middleware\TransformParamCamelCaseToSnakeCase;
use PandaZoom\LaravelArticle\Http\Requests\ArticlePatchRequest;
use PandaZoom\LaravelArticle\Http\Resources\ArticleResource;
use PandaZoom\LaravelArticle\Models\Article;
use function app;

class ArticlePatchController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'auth:api',
            TransformParamCamelCaseToSnakeCase::class,
        ]);
    }

    public function __invoke(ArticlePatchRequest $request, Article $article, PatchArticleActionContract $action): ArticleResource
    {
        $this->authorize('update', $article);

        app('db')->transaction(static fn () => $action->run($article, $request->safe()->collect()));

        return new ArticleResource($article);
    }
}
