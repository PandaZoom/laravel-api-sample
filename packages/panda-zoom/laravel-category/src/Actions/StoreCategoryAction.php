<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Actions;

use PandaZoom\LaravelBase\Exceptions\EmptyIncomeDataException;
use PandaZoom\LaravelCategory\Contracts\StoreCategoryActionContract;
use PandaZoom\LaravelCategory\Exceptions\CategoryNotCreatedException;
use PandaZoom\LaravelCategory\Exceptions\CategoryTranslationNotCreatedException;
use PandaZoom\LaravelCategory\Models\Category;
use PandaZoom\LaravelCategory\Tasks\StoreCategoryTranslationTask;
use function app;
use function throw_if;

class StoreCategoryAction implements StoreCategoryActionContract
{
    /**
     * @inheritDoc
     */
    public function run(array $attributes): Category
    {
        throw_if(
            empty($attributes),
            EmptyIncomeDataException::class
        );

        $category = Category::create([
            'active' => $attributes['active'],
            'position' => $attributes['position'] ?? 0,
        ]);

        throw_if(
            !($category instanceof Category),
            CategoryNotCreatedException::class,
        );

        $translations = app(StoreCategoryTranslationTask::class)->run($category, $attributes['translations']);

        throw_if(
            $translations->isEmpty(),
            CategoryTranslationNotCreatedException::class
        );

        $category->load(['translations']);

        return $category;
    }
}
