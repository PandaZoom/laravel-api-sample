<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Actions;

use Illuminate\Support\Collection;
use PandaZoom\LaravelArticle\Contracts\PatchArticleActionContract;
use PandaZoom\LaravelArticle\Exceptions\ArticleNotUpdatedException;
use PandaZoom\LaravelArticle\Models\Article;
use PandaZoom\LaravelBase\Exceptions\EmptyIncomeDataException;
use function app;
use function throw_if;

class PatchArticleAction implements PatchArticleActionContract
{
    public function run(Article $article, Collection $attributes): bool
    {
        throw_if(
            $attributes->isEmpty(),
            EmptyIncomeDataException::class
        );

        $isSuccess = $article->updateOrFail($attributes->only([
            'status_id',
            'published_at',
            'expires_at',
        ])->toArray());

        if ($attributes->has('translations')) {

            $article->translations()->delete();

            $translations = $article->translations()->createMany($attributes->get('translations'));

            throw_if(
                $translations->isEmpty(),
                ArticleNotUpdatedException::class
            );

            $article->setRelation('translations', $translations);

        } else {
            $article->load('translations');
        }

        if ($attributes->has('category_id')) {
            $article->categories()->sync($attributes->get('category_id'));
        }

        $with = app(ArticleSupportRelationAction::class)->run();

        if (!empty($with)) {
            $article->loadMissing($with);
        }

        return $isSuccess;
    }
}
