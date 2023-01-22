<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Actions;

use Illuminate\Support\Facades\Hash;
use PandaZoom\LaravelBase\Exceptions\EmptyIncomeDataException;
use PandaZoom\LaravelBase\Services\RelationByRequest;
use PandaZoom\LaravelUser\Contracts\RegisterUserActionContract;
use PandaZoom\LaravelUser\Exceptions\UserNotCreatedException;
use PandaZoom\LaravelUser\Models\User;
use function app;
use function throw_if;

class RegisterUserAction implements RegisterUserActionContract
{
    public function run(array $attributes): User
    {
        throw_if(
            empty($attributes),
            EmptyIncomeDataException::class
        );

        $attributes['password'] = Hash::make($attributes['password']);

        $user = User::query()->create($attributes);

        throw_if(
            !($user instanceof User),
            UserNotCreatedException::class
        );

        $with = app(RelationByRequest::class)
            ->addSupportedWith(['language'])
            ->filterWith();

        if (!empty($with)) {
            $user->load($with);
        }

        return $user;
    }
}
