<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Tasks;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use PandaZoom\LaravelArticle\Models\Article;

class CursorPaginateArticleTask
{
    /**
     * @param Collection $filter
     * @param array $relation
     * @return \Illuminate\Contracts\Pagination\CursorPaginator|\PandaZoom\LaravelArticle\Models\Article[]
     */
    public function run(Collection $filter, array $relation = []): CursorPaginator
    {
        return Article::query()
            ->withTranslation()
            ->when(
                !empty($relation),
                fn(Builder $query) => $query->with($relation)
            )
            ->when(
                $filter->has('status_id'),
                static fn(Builder $query) => $query->where('status_id', $filter->get('status_id'))
            )
            ->when(
                $filter->has('user_id'),
                static fn(Builder $query) => $query->where('user_id', $filter->get('user_id'))
            )
            ->cursorPaginate();
    }
}
