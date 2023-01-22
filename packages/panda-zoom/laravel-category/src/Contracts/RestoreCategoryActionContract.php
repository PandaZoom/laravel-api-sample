<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Contracts;

use PandaZoom\LaravelCategory\Models\Category;

interface RestoreCategoryActionContract
{
    /**
     * @param Category $category
     * @return bool
     * @throws \Throwable
     */
    public function run(Category $category): bool;
}
