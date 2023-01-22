<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Contracts;

use PandaZoom\LaravelCategory\Models\Category;

interface StoreCategoryActionContract
{
    /**
     * @param array $attributes
     * @return Category
     * @throws \Throwable
     */
    public function run(array $attributes): Category;
}
