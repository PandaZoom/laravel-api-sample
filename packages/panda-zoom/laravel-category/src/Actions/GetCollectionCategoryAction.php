<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Actions;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Collection as DatabaseCollection;
use Illuminate\Support\Collection;
use PandaZoom\LaravelBase\Services\RelationByRequest;
use PandaZoom\LaravelCategory\Contracts\GetCollectionCategoryActionContract;
use PandaZoom\LaravelCategory\Models\Category;
use PandaZoom\LaravelCategory\Tasks\CategoryCollectionTask;
use function app;

class GetCollectionCategoryAction implements GetCollectionCategoryActionContract
{
    public function __construct(protected CategoryCollectionTask $task)
    {
        //
    }

    /**
     * @param Collection $filters
     * @return DatabaseCollection|Category[]
     */
    public function run(Collection $filters): DatabaseCollection
    {
        $with = app(RelationByRequest::class)
            ->addSupportedWith(['translations', 'translation'])
            ->filterWith();

        return $this->task->run($filters, $with);
    }
}
