<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Actions;

use PandaZoom\LaravelArticle\Contracts\ShowArticleActionContract;
use PandaZoom\LaravelArticle\Events\ArticleShown;
use PandaZoom\LaravelArticle\Models\Article;
use function app;
use function event;

class ShowArticleAction implements ShowArticleActionContract
{
    public function run(Article $article): void
    {
        $article->withTranslation();

        $with = app(ArticleSupportRelationAction::class)->run();

        if (!empty($with)) {
            $article->load($with);
        }

        $article->views++;

        event(new ArticleShown($article));
    }
}
