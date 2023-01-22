<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Tasks;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use PandaZoom\LaravelStatus\Models\Status;

class StatusCollectionTask
{
    /**
     * @param Collection $filter
     * @param array $relation
     * @return EloquentCollection|\PandaZoom\LaravelStatus\Models\Status[]
     */
    public function run(Collection $filter, array $relation = []): EloquentCollection
    {
        return Status::query()
            ->when(
                !empty($relation),
                fn(Builder $query) => $query->with($relation)
            )
            ->when(
                $filter->has('user_id'),
                static fn(Builder $query) => $query->where('user_id', $filter->get('user_id'))
            )
            ->get();
    }
}
