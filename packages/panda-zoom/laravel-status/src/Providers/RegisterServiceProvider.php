<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use PandaZoom\LaravelStatus\Actions\StatusCollectionAction;
use PandaZoom\LaravelStatus\Actions\DeleteStatusAction;
use PandaZoom\LaravelStatus\Actions\StoreStatusAction;
use PandaZoom\LaravelStatus\Actions\RestoreStatusAction;
use PandaZoom\LaravelStatus\Actions\UpdateStatusAction;
use PandaZoom\LaravelStatus\Actions\ShowStatusAction;
use PandaZoom\LaravelStatus\Contracts\StatusCollectionActionContract;
use PandaZoom\LaravelStatus\Contracts\DeleteStatusActionContract;
use PandaZoom\LaravelStatus\Contracts\StoreStatusActionContract;
use PandaZoom\LaravelStatus\Contracts\RestoreStatusActionContract;
use PandaZoom\LaravelStatus\Contracts\UpdateStatusActionContract;
use PandaZoom\LaravelStatus\Contracts\ShowStatusActionContract;
use function class_exists;
use function interface_exists;

class_exists(StatusCollectionAction::class);
class_exists(StoreStatusAction::class);
class_exists(UpdateStatusAction::class);
class_exists(DeleteStatusAction::class);
class_exists(RestoreStatusAction::class);
class_exists(ShowStatusAction::class);
interface_exists(StatusCollectionActionContract::class);
interface_exists(DeleteStatusActionContract::class);
interface_exists(StoreStatusActionContract::class);
interface_exists(RestoreStatusActionContract::class);
interface_exists(UpdateStatusActionContract::class);
interface_exists(ShowStatusActionContract::class);

class RegisterServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->singletonIf(StatusCollectionActionContract::class, StatusCollectionAction::class);
        $this->app->singletonIf(StoreStatusActionContract::class, StoreStatusAction::class);
        $this->app->singletonIf(UpdateStatusActionContract::class, UpdateStatusAction::class);
        $this->app->singletonIf(DeleteStatusActionContract::class, DeleteStatusAction::class);
        $this->app->singletonIf(RestoreStatusActionContract::class, RestoreStatusAction::class);
        $this->app->singletonIf(ShowStatusActionContract::class, ShowStatusAction::class);
    }

    /**
     * @inheritDoc
     *
     * @return array<int, class-string|string>
     */
    public function provides(): array
    {
        return [
            StatusCollectionActionContract::class,
            StoreStatusActionContract::class,
            UpdateStatusActionContract::class,
            DeleteStatusActionContract::class,
            RestoreStatusActionContract::class,
            ShowStatusActionContract::class,
        ];
    }
}
