<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Contracts;

use Illuminate\Database\Eloquent\Collection as DatabaseCollection;
use Illuminate\Support\Collection;
use PandaZoom\LaravelCategory\Models\Category;

interface GetCollectionCategoryActionContract
{
    /**
     * @param Collection $filters
     * @return DatabaseCollection|Category[]
     */
    public function run(Collection $filters): DatabaseCollection;
}
