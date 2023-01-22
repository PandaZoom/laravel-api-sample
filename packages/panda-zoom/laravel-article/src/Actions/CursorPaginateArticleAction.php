<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Actions;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Support\Collection;
use PandaZoom\LaravelArticle\Contracts\CursorPaginateArticleActionContract;
use PandaZoom\LaravelArticle\Tasks\CursorPaginateArticleTask;
use function app;

class CursorPaginateArticleAction implements CursorPaginateArticleActionContract
{
    public function __construct(protected CursorPaginateArticleTask $task)
    {
        //
    }

    /**
     * @param Collection $filter
     * @return \Illuminate\Contracts\Pagination\CursorPaginator|\PandaZoom\LaravelArticle\Models\Article[]
     */
    public function run(Collection $filter): CursorPaginator
    {
        $with = app(ArticleSupportRelationAction::class)->run();

        return $this->task->run($filter, $with);
    }
}
