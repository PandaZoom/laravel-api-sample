<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Actions;

use PandaZoom\LaravelArticle\Contracts\DeleteArticleActionContract;
use PandaZoom\LaravelArticle\Exceptions\ArticleNotDeletedException;
use PandaZoom\LaravelArticle\Models\Article;
use function throw_if;

class DeleteArticleAction implements DeleteArticleActionContract
{
    public function run(Article $article, bool $permanent = false): ?bool
    {
        $isSuccess = $permanent ? $article->forceDelete() : $article->delete();

        throw_if(
            ! $isSuccess,
            ArticleNotDeletedException::class
        );

        return $isSuccess;
    }
}
