<?php

namespace PandaZoom\LaravelArticle\Contracts;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Support\Collection;

interface CursorPaginateArticleActionContract
{
    /**
     * @param  Collection  $filter
     * @return \Illuminate\Contracts\Pagination\CursorPaginator|\PandaZoom\LaravelArticle\Models\Article[]
     */
    public function run(Collection $filter): CursorPaginator;
}
