<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Actions;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use PandaZoom\LaravelBase\Services\RelationByRequest;
use PandaZoom\LaravelUser\Contracts\CursorPaginateUserActionContract;
use PandaZoom\LaravelUser\Tasks\CursorPaginateUserTask;
use function app;

class CursorPaginateUserAction implements CursorPaginateUserActionContract
{
    public function __construct(protected CursorPaginateUserTask $task)
    {
        //
    }

    /**
     * @param Collection $filter
     * @return \Illuminate\Contracts\Pagination\CursorPaginator|\PandaZoom\LaravelUser\Models\User[]
     */
    public function run(Collection $filter): CursorPaginator
    {
        $with = app(RelationByRequest::class)
            ->addSupportedWith([
                'language',
                'articles' => static fn(HasMany $q) => $q->withTranslation(),
                'article' => static fn(HasMany $q) => $q->withTranslation(),
            ])
            ->filterWith();

        return $this->task->run($filter, $with);
    }
}
