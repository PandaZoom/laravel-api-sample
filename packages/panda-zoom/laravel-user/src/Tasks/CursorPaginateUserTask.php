<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Tasks;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use PandaZoom\LaravelUser\Models\User;

class CursorPaginateUserTask
{
    /**
     * @param Collection $filter
     * @param array $relation
     * @return \Illuminate\Contracts\Pagination\CursorPaginator|\PandaZoom\LaravelUser\Models\User[]
     */
    public function run(Collection $filter, array $relation = []): CursorPaginator
    {
        return User::query()
            ->when(
                !empty($relation),
                fn(Builder $query) => $query->with($relation)
            )
            ->when(
                $filter->has('active'),
                function (Builder $query) use ($filter) {
                    if ($filter->get('active')) {
                        $query->active();
                    } else {
                        $query->notActive();
                    }
                }
            )
            ->when(
                $filter->has('first_name'),
                fn(Builder $query) => $query->where('first_name', 'like', "%{$filter->get('first_name')}%")
            )
            ->when(
                $filter->has('last_name'),
                fn(Builder $query) => $query->where('last_name', 'like', "%{$filter->get('last_name')}%")
            )
            ->when(
                $filter->has('timezone'),
                fn(Builder $query) => $query->where('timezone', $filter->get('timezone'))
            )
            ->when(
                $filter->has('locale'),
                fn(Builder $query) => $query->where('locale', $filter->get('locale'))
            )
            ->cursorPaginate();
    }
}
