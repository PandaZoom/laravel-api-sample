<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Actions;

use Illuminate\Support\Collection;
use PandaZoom\LaravelArticle\Contracts\StoreArticleActionContract;
use PandaZoom\LaravelArticle\Exceptions\ArticleTranslationNotCreatedException;
use PandaZoom\LaravelArticle\Exceptions\MissingArticleTranslationException;
use PandaZoom\LaravelArticle\Models\Article;
use PandaZoom\LaravelBase\Exceptions\EmptyIncomeDataException;
use PandaZoom\LaravelUser\Exceptions\UserNotCreatedException;
use function app;
use function throw_if;

class StoreArticleAction implements StoreArticleActionContract
{
    public function run(Collection $attributes): Article
    {
        throw_if(
            $attributes->isEmpty(),
            EmptyIncomeDataException::class
        );

        throw_if(
            !$attributes->has('translations') || empty($attributes->get('translations')),
            MissingArticleTranslationException::class
        );

        $article = Article::query()->create($attributes->only([
            'status_id',
            'published_at',
            'expires_at',
        ])->toArray());

        throw_if(
            !($article instanceof Article),
            UserNotCreatedException::class
        );

        $translations = $article->translations()->createMany($attributes->get('translations'));

        throw_if(
            $translations->isEmpty(),
            ArticleTranslationNotCreatedException::class
        );

        $article->categories()->sync($attributes->get('category_id'));

        $with = app(ArticleSupportRelationAction::class)->run();

        if (!empty($with)) {
            $article->loadMissing($with);
        }

        return $article;
    }
}
