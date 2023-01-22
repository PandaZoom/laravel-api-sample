<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use PandaZoom\LaravelArticle\Contracts\DeleteArticleActionContract;
use PandaZoom\LaravelArticle\Models\Article;
use function app;
use function response;
use function class_exists;

class_exists(Article::class);

class ArticleDeleteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function __invoke(Article $article, DeleteArticleActionContract $action): JsonResponse
    {
        $this->authorize('delete', $article);

        app('db')->transaction(static fn () => $action->run($article, true));

        return response()->json([]);
    }
}
