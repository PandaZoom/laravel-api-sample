<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Actions;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use PandaZoom\LaravelStatus\Contracts\StatusCollectionActionContract;
use PandaZoom\LaravelStatus\Tasks\StatusCollectionTask;
use function app;

class StatusCollectionAction implements StatusCollectionActionContract
{
    public function __construct(protected StatusCollectionTask $task)
    {
        //
    }

    /**
     * @param Collection $filter
     * @return EloquentCollection|\PandaZoom\LaravelStatus\Models\Status[]
     */
    public function run(Collection $filter): EloquentCollection
    {
        $with = app(StatusSupportRelationAction::class)->run();

        return $this->task->run($filter, $with);
    }
}
