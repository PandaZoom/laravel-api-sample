<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Actions;

use PandaZoom\LaravelUser\Contracts\DeleteUserActionContract;
use PandaZoom\LaravelUser\Exceptions\UserNotDeletedException;
use PandaZoom\LaravelUser\Models\User;
use function throw_if;

class DeleteUserAction implements DeleteUserActionContract
{
    public function run(User $user, bool $permanent = false): ?bool
    {
        $isSuccess = $permanent ? $user->forceDelete() : $user->deleteOrFail();

        throw_if(
            ! $isSuccess,
            UserNotDeletedException::class
        );

        return $isSuccess;
    }
}
