<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Tasks;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as DatabaseCollection;
use Illuminate\Support\Collection;
use PandaZoom\LaravelCategory\Models\Category;

class CategoryCollectionTask
{
    /**
     * @param Collection $filter
     * @param array $relation
     * @return \Illuminate\Database\Eloquent\Collection|\PandaZoom\LaravelCategory\Models\Category[]
     */
    public function run(Collection $filter, array $relation = []): DatabaseCollection
    {
        return Category::query()
            ->withTranslation()
            ->when(
                !empty($relation),
                fn(Builder $query) => $query->with($relation)
            )
            ->when(
                $filter->has('active'),
                static function (Builder|Category $query) use ($filter) {
                    if ($filter->get('active')) {
                        $query->active();
                    } else {
                        $query->notActive();
                    }
                },
            )
            ->when(
                $filter->has('user_id'),
                static fn(Builder $query) => $query->where('user_id', $filter->get('user_id'))
            )
            ->get();
    }
}
