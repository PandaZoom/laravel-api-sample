<?php
declare(strict_types=1);

namespace PandaZoom\LaravelComment\Tasks;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use PandaZoom\LaravelComment\Models\Comment;

class CursorPaginateCommentTask
{
    /**
     * @param Collection $filter
     * @param array $relation
     * @return \Illuminate\Contracts\Pagination\CursorPaginator|\PandaZoom\LaravelComment\Models\Comment[]
     */
    public function run(Collection $filter, array $relation = []): CursorPaginator
    {
        return Comment::query()
            ->when(
                !empty($relation),
                fn(Builder $query) => $query->with($relation)
            )
            ->when(
                $filter->has('user_id'),
                static fn(Builder $query) => $query->where('user_id', $filter->get('user_id'))
            )
            ->when(
                $filter->has('message'),
                static fn(Builder $query) => $query->where('message', 'like', "%{$filter->get('message')}%")
            )
            ->cursorPaginate();
    }
}
