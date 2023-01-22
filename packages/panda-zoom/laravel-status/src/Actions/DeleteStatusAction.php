<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Actions;

use PandaZoom\LaravelStatus\Contracts\DeleteStatusActionContract;
use PandaZoom\LaravelStatus\Exceptions\StatusNotDeletedException;
use PandaZoom\LaravelStatus\Models\Status;
use function throw_if;

class DeleteStatusAction implements DeleteStatusActionContract
{
    public function run(Status $status, bool $permanent = false): ?bool
    {
        $isSuccess = $permanent ? $status->forceDelete() : $status->delete();

        throw_if(
            ! $isSuccess,
            StatusNotDeletedException::class
        );

        return $isSuccess;
    }
}
