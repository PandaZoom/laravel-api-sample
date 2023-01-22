<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Actions;

use Illuminate\Support\Collection;
use PandaZoom\LaravelBase\Exceptions\EmptyIncomeDataException;
use PandaZoom\LaravelStatus\Contracts\UpdateStatusActionContract;
use PandaZoom\LaravelStatus\Models\Status;
use function app;
use function throw_if;

class UpdateStatusAction implements UpdateStatusActionContract
{
    public function run(Status $status, Collection $attributes): bool
    {
        throw_if(
            $attributes->isEmpty(),
            EmptyIncomeDataException::class
        );

        $isSuccess = $status->updateOrFail($attributes->only([
            'slug',
        ])->toArray());

        $with = app(StatusSupportRelationAction::class)->run();

        if (!empty($with)) {
            $status->loadMissing($with);
        }

        return $isSuccess;
    }
}
