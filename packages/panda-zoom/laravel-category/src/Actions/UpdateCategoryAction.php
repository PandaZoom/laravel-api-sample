<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Actions;

use PandaZoom\LaravelBase\Exceptions\EmptyIncomeDataException;
use PandaZoom\LaravelCategory\Contracts\UpdateCategoryActionContract;
use PandaZoom\LaravelCategory\Exceptions\CategoryNotUpdatedException;
use PandaZoom\LaravelCategory\Exceptions\CategoryTranslationNotUpdatedException;
use PandaZoom\LaravelCategory\Models\Category;
use PandaZoom\LaravelCategory\Tasks\StoreCategoryTranslationTask;
use function app;
use function throw_if;

class UpdateCategoryAction implements UpdateCategoryActionContract
{
    public function run(Category $category, array $attributes): bool
    {
        throw_if(
            empty($attributes),
            EmptyIncomeDataException::class
        );

        $isSuccess = $category->update([
            'active' => $attributes['active'],
            'position' => $attributes['position'] ?? 0,
        ]);

        throw_if(
            !$isSuccess,
            CategoryNotUpdatedException::class
        );

        $translations = app(StoreCategoryTranslationTask::class)->run($category, $attributes['translations']);

        throw_if(
            $translations->isEmpty(),
            CategoryTranslationNotUpdatedException::class
        );

        $category->load(['translations']);

        return $isSuccess;
    }
}
