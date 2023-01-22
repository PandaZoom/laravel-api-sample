<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Actions;

use PandaZoom\LaravelCategory\Contracts\DeleteCategoryActionContract;
use PandaZoom\LaravelCategory\Exceptions\CategoryNotDeletedException;
use PandaZoom\LaravelCategory\Models\Category;
use function throw_if;

class DeleteCategoryAction implements DeleteCategoryActionContract
{
    public function run(Category $category): ?bool
    {
        $isSuccess = $category->delete();

        throw_if(
            !$isSuccess,
            CategoryNotDeletedException::class
        );

        return $isSuccess;
    }
}
