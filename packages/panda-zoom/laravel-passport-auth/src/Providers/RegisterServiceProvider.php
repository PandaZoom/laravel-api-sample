<?php
declare(strict_types=1);

namespace PandaZoom\LaravelPassportAuth\Providers;

use function class_exists;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use PandaZoom\LaravelPassportAuth\Actions\RegisterNewUserAction;
use PandaZoom\LaravelPassportAuth\Contracts\RegisterNewUserActionContract;
use PandaZoom\LaravelUser\Contracts\RegisterUserActionContract;

class_exists(RegisterNewUserAction::class);

class RegisterServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $this->app->singletonIf(RegisterNewUserActionContract::class, RegisterNewUserAction::class);
    }

    /**
     * @inheritDoc
     *
     * @return string[]
     */
    public function provides(): array
    {
        return [
            RegisterUserActionContract::class,
        ];
    }
}
