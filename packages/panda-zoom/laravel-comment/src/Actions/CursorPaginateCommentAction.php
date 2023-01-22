<?php
declare(strict_types=1);

namespace PandaZoom\LaravelComment\Actions;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Support\Collection;
use PandaZoom\LaravelBase\Services\RelationByRequest;
use PandaZoom\LaravelComment\Contracts\CursorPaginateCommentActionContract;
use PandaZoom\LaravelComment\Tasks\CursorPaginateCommentTask;
use function app;

class CursorPaginateCommentAction implements CursorPaginateCommentActionContract
{
    public function __construct(protected CursorPaginateCommentTask $task)
    {
        //
    }

    /**
     * @param  Collection  $filter
     * @return \Illuminate\Contracts\Pagination\CursorPaginator|\PandaZoom\LaravelArticle\Models\Article[]
     */
    public function run(Collection $filter): CursorPaginator
    {
        $with = app(RelationByRequest::class)
            ->addSupportedWith(['user'])
            ->filterWith();

        return $this->task->run($filter, $with);
    }
}
