<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Actions;

use Illuminate\Support\Collection;
use PandaZoom\LaravelArticle\Contracts\UpdateArticleActionContract;
use PandaZoom\LaravelArticle\Exceptions\ArticleNotUpdatedException;
use PandaZoom\LaravelArticle\Exceptions\MissingArticleTranslationException;
use PandaZoom\LaravelArticle\Models\Article;
use PandaZoom\LaravelBase\Exceptions\EmptyIncomeDataException;
use function app;
use function throw_if;

class UpdateArticleAction implements UpdateArticleActionContract
{
    public function run(Article $article, Collection $attributes): bool
    {
        throw_if(
            $attributes->isEmpty(),
            EmptyIncomeDataException::class
        );

        throw_if(
            !$attributes->has('translations') || empty($attributes->get('translations')),
            MissingArticleTranslationException::class
        );

        $isSuccess = $article->updateOrFail($attributes->only([
            'status_id',
            'published_at',
            'expires_at',
        ])->toArray());

        $article->translations()->delete();

        $translations = $article->translations()->createMany($attributes->get('translations'));

        throw_if(
            $translations->isEmpty(),
            ArticleNotUpdatedException::class
        );

        $article->categories()->sync($attributes->get('category_id'));

        $article->setRelation('translations', $translations);

        $with = app(ArticleSupportRelationAction::class)->run();

        if (!empty($with)) {
            $article->loadMissing($with);
        }

        return $isSuccess;
    }
}
