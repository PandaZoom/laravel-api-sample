<?php
declare(strict_types=1);

namespace PandaZoom\LaravelLanguage\Tasks;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use PandaZoom\LaravelLanguage\Models\Language;

class GetLanguageCollectionTask
{
    public function run(SupportCollection $filter, array $columns = ['*'], array $relation = []): Collection
    {
        return Language::query()
            ->when(
                !empty($relation),
                fn(Builder $query) => $query->with($relation)
            )
            ->when(
                $filter->has('active'),
                static fn(Builder $query) => $query->where('active', (bool)$filter->get('active', false))
            )
            ->when(
                $filter->has('locale'),
                static fn(Builder $query) => $query->where('locale', $filter->get('locale'))
            )
            ->get($columns);
    }
}
