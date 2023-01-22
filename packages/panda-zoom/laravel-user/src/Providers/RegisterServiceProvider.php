<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use PandaZoom\LaravelUser\Actions\CursorPaginateUserAction;
use PandaZoom\LaravelUser\Actions\DeleteUserAction;
use PandaZoom\LaravelUser\Actions\RegisterUserAction;
use PandaZoom\LaravelUser\Actions\RestoreUserAction;
use PandaZoom\LaravelUser\Actions\UpdateUserAction;
use PandaZoom\LaravelUser\Contracts\CursorPaginateUserActionContract;
use PandaZoom\LaravelUser\Contracts\DeleteUserActionContract;
use PandaZoom\LaravelUser\Contracts\RegisterUserActionContract;
use PandaZoom\LaravelUser\Contracts\RestoreUserActionContract;
use PandaZoom\LaravelUser\Contracts\UpdateUserActionContract;
use function class_exists;
use function interface_exists;

class_exists(CursorPaginateUserAction::class);
class_exists(RegisterUserAction::class);
class_exists(UpdateUserAction::class);
class_exists(DeleteUserAction::class);
class_exists(RestoreUserAction::class);
interface_exists(CursorPaginateUserActionContract::class);
interface_exists(DeleteUserActionContract::class);
interface_exists(RegisterUserActionContract::class);
interface_exists(RestoreUserActionContract::class);
interface_exists(UpdateUserActionContract::class);

class RegisterServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $this->app->singletonIf(CursorPaginateUserActionContract::class, CursorPaginateUserAction::class);
        $this->app->singletonIf(RegisterUserActionContract::class, RegisterUserAction::class);
        $this->app->singletonIf(UpdateUserActionContract::class, UpdateUserAction::class);
        $this->app->singletonIf(DeleteUserActionContract::class, DeleteUserAction::class);
        $this->app->singletonIf(RestoreUserActionContract::class, RestoreUserAction::class);
    }

    /**
     * @inheritDoc
     *
     * @return array<int, class-string|string>
     */
    public function provides(): array
    {
        return [
            CursorPaginateUserActionContract::class,
            RegisterUserActionContract::class,
            UpdateUserActionContract::class,
            DeleteUserActionContract::class,
            RestoreUserActionContract::class,
        ];
    }
}
