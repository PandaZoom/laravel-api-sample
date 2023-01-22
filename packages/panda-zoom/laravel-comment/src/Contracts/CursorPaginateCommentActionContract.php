<?php

namespace PandaZoom\LaravelComment\Contracts;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Support\Collection;

interface CursorPaginateCommentActionContract
{
    /**
     * @param  Collection  $filter
     * @return \Illuminate\Contracts\Pagination\CursorPaginator|\PandaZoom\LaravelArticle\Models\Article[]
     */
    public function run(Collection $filter): CursorPaginator;
}
