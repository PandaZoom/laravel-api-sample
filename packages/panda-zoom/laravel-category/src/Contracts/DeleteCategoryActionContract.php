<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Contracts;

use PandaZoom\LaravelCategory\Models\Category;

interface DeleteCategoryActionContract
{
    /**
     * @param Category $category
     * @return bool|null
     * @throws \Throwable
     */
    public function run(Category $category): ?bool;
}
