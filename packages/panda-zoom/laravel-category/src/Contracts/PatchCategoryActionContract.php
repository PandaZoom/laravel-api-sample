<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Contracts;

use PandaZoom\LaravelCategory\Models\Category;

interface PatchCategoryActionContract
{
    /**
     * @param Category $category
     * @param array $attributes
     * @return void
     * @throws \Throwable
     */
    public function run(Category $category, array $attributes): void;
}
