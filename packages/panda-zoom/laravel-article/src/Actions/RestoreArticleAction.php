<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Actions;

use PandaZoom\LaravelArticle\Contracts\RestoreArticleActionContract;
use PandaZoom\LaravelArticle\Exceptions\ArticleNotRestoredException;
use PandaZoom\LaravelArticle\Models\Article;
use function throw_if;

class RestoreArticleAction implements RestoreArticleActionContract
{
    /**
     * @inheritDoc
     */
    public function run(Article $article): ?bool
    {
        $isSuccess = (bool)$article->restore();

        throw_if(
            !$isSuccess,
            ArticleNotRestoredException::class
        );

        $with = app(ArticleSupportRelationAction::class)->run();

        if (!empty($with)) {
            $article->load($with);
        }

        return $isSuccess;
    }
}
