<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Actions;

use PandaZoom\LaravelStatus\Contracts\RestoreStatusActionContract;
use PandaZoom\LaravelStatus\Exceptions\StatusNotRestoredException;
use PandaZoom\LaravelStatus\Models\Status;
use function throw_if;

class RestoreStatusAction implements RestoreStatusActionContract
{
    /**
     * @inheritDoc
     */
    public function run(Status $status): ?bool
    {
        $isSuccess = $status->restore();

        throw_if(
            !$isSuccess,
            StatusNotRestoredException::class
        );

        $with = app(StatusSupportRelationAction::class)->run();

        if (!empty($with)) {
            $status->load($with);
        }

        return $isSuccess;
    }
}
