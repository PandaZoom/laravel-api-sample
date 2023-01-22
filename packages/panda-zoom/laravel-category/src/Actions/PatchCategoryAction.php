<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Actions;

use PandaZoom\LaravelBase\Exceptions\EmptyIncomeDataException;
use PandaZoom\LaravelCategory\Contracts\PatchCategoryActionContract;
use PandaZoom\LaravelCategory\Exceptions\CategoryNotUpdatedException;
use PandaZoom\LaravelCategory\Exceptions\CategoryTranslationNotUpdatedException;
use PandaZoom\LaravelCategory\Models\Category;
use PandaZoom\LaravelCategory\Tasks\StoreCategoryTranslationTask;
use function app;
use function throw_if;

class PatchCategoryAction implements PatchCategoryActionContract
{
    /**
     * @param Category $category
     * @param array $attributes
     * @return void
     * @throws \Throwable
     */
    public function run(Category $category, array $attributes): void
    {
        throw_if(
            empty($attributes),
            EmptyIncomeDataException::class,
        );

        $this->patchRootTable($category, $attributes);

        $this->patchTranslationTable($category, $attributes);

        $category->load(['translations']);
    }

    /**
     * @param Category $category
     * @param array $attributes
     * @return void
     * @throws \Throwable
     */
    protected function patchRootTable(Category $category, array $attributes): void
    {
        $update = [];

        if (isset($attributes['active'])) {
            $update['active'] = $attributes['active'];
        }

        if (isset($attributes['position'])) {
            $update['position'] = $attributes['position'];
        }

        if (!empty($update)) {

            throw_if(
                !$category->update($update),
                CategoryNotUpdatedException::class
            );
        }
    }

    /**
     * @param Category $category
     * @param array $attributes
     * @return void
     * @throws \Throwable
     */
    protected function patchTranslationTable(Category $category, array $attributes): void
    {
        if (!empty($attributes['translations'])) {

            $translations = app(StoreCategoryTranslationTask::class)->run($category, $attributes['translations']);

            throw_if(
                $translations->isEmpty(),
                CategoryTranslationNotUpdatedException::class
            );
        }
    }
}
