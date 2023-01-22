<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Contracts;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

interface StatusCollectionActionContract
{
    /**
     * @param Collection $filter
     * @return EloquentCollection|\PandaZoom\LaravelStatus\Models\Status[]
     */
    public function run(Collection $filter): EloquentCollection;
}
