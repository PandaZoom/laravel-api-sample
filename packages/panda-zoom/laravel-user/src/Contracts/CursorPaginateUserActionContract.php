<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Contracts;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Support\Collection;

interface CursorPaginateUserActionContract
{
    /**
     * @param  Collection  $filter
     * @return \Illuminate\Contracts\Pagination\CursorPaginator|\PandaZoom\LaravelUser\Models\User[]
     */
    public function run(Collection $filter): CursorPaginator;
}
