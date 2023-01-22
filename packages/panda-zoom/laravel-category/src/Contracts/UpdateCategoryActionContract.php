<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Contracts;

use PandaZoom\LaravelCategory\Models\Category;

interface UpdateCategoryActionContract
{
    /**
     * @param Category $category
     * @param array $attributes
     * @return bool
     * @throws \Throwable
     */
    public function run(Category $category, array $attributes): bool;
}
