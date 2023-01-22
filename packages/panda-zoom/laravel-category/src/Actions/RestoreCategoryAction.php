<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Actions;

use PandaZoom\LaravelCategory\Contracts\RestoreCategoryActionContract;
use PandaZoom\LaravelCategory\Exceptions\CategoryNotUpdatedException;
use PandaZoom\LaravelCategory\Models\Category;
use function throw_if;

class RestoreCategoryAction implements RestoreCategoryActionContract
{
    public function run(Category $category): bool
    {
        $isSuccess = $category->restoreQuietly();

        throw_if(
            !$isSuccess,
            CategoryNotUpdatedException::class
        );

        $category->load(['translations']);

        return $isSuccess;
    }
}
