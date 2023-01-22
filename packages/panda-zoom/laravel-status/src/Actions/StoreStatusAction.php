<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Actions;

use Illuminate\Support\Collection;
use PandaZoom\LaravelBase\Exceptions\EmptyIncomeDataException;
use PandaZoom\LaravelBase\Services\RelationByRequest;
use PandaZoom\LaravelStatus\Contracts\StoreStatusActionContract;
use PandaZoom\LaravelStatus\Models\Status;
use PandaZoom\LaravelUser\Exceptions\UserNotCreatedException;
use PandaZoom\LaravelUser\Models\User;
use function app;
use function in_array;
use function request;
use function throw_if;

class StoreStatusAction implements StoreStatusActionContract
{
    public function run(Collection $attributes): Status
    {
        throw_if(
            $attributes->isEmpty(),
            EmptyIncomeDataException::class
        );

        $status = Status::query()->create($attributes->only([
            'slug',
        ])->toArray());

        throw_if(
            !($status instanceof Status),
            UserNotCreatedException::class
        );

        $this->withRelations($status);

        return $status;
    }

    protected function withRelations(Status $status): void
    {
        $with = app(RelationByRequest::class)
            ->addSupportedWith(['user'])
            ->filterWith();

        if (!empty($with) && in_array('user', $with, true)) {
            $user = request()?->user();

            if ($user instanceof User) {
                $status->setRelation('user', $user);
            } else {
                $status->loadMissing($with);
            }
        }
    }
}
