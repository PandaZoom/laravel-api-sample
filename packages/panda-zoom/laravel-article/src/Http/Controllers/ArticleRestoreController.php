<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Http\Controllers;

use App\Http\Controllers\Controller;
use PandaZoom\LaravelArticle\Contracts\RestoreArticleActionContract;
use PandaZoom\LaravelArticle\Http\Resources\ArticleResource;
use PandaZoom\LaravelArticle\Models\Article;
use function app;

class ArticleRestoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function __invoke(Article $article, RestoreArticleActionContract $action): ArticleResource
    {
        $this->authorize('update', $article);

        app('db')->transaction(static fn() => $action->run($article));

        return new ArticleResource($article);
    }
}
