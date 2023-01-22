<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use PandaZoom\LaravelCategory\Actions\DeleteCategoryAction;
use PandaZoom\LaravelCategory\Actions\GetCollectionCategoryAction;
use PandaZoom\LaravelCategory\Actions\PatchCategoryAction;
use PandaZoom\LaravelCategory\Actions\RestoreCategoryAction;
use PandaZoom\LaravelCategory\Actions\StoreCategoryAction;
use PandaZoom\LaravelCategory\Actions\UpdateCategoryAction;
use PandaZoom\LaravelCategory\Contracts\DeleteCategoryActionContract;
use PandaZoom\LaravelCategory\Contracts\GetCollectionCategoryActionContract;
use PandaZoom\LaravelCategory\Contracts\PatchCategoryActionContract;
use PandaZoom\LaravelCategory\Contracts\RestoreCategoryActionContract;
use PandaZoom\LaravelCategory\Contracts\StoreCategoryActionContract;
use PandaZoom\LaravelCategory\Contracts\UpdateCategoryActionContract;
use function class_exists;
use function interface_exists;

class_exists(GetCollectionCategoryAction::class);
class_exists(StoreCategoryAction::class);
class_exists(UpdateCategoryAction::class);
class_exists(PatchCategoryAction::class);
class_exists(DeleteCategoryAction::class);
class_exists(RestoreCategoryAction::class);
interface_exists(GetCollectionCategoryActionContract::class);
interface_exists(StoreCategoryActionContract::class);
interface_exists(UpdateCategoryActionContract::class);
interface_exists(PatchCategoryActionContract::class);
interface_exists(DeleteCategoryActionContract::class);
interface_exists(RestoreCategoryActionContract::class);

class RegisterServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $this->app->singletonIf(GetCollectionCategoryActionContract::class, GetCollectionCategoryAction::class);
        $this->app->singletonIf(StoreCategoryActionContract::class, StoreCategoryAction::class);
        $this->app->singletonIf(UpdateCategoryActionContract::class, UpdateCategoryAction::class);
        $this->app->singletonIf(PatchCategoryActionContract::class, PatchCategoryAction::class);
        $this->app->singletonIf(DeleteCategoryActionContract::class, DeleteCategoryAction::class);
        $this->app->singletonIf(RestoreCategoryActionContract::class, RestoreCategoryAction::class);
    }

    /**
     * @inheritDoc
     *
     * @return array<int, class-string|string>
     */
    public function provides(): array
    {
        return [
            GetCollectionCategoryActionContract::class,
            StoreCategoryActionContract::class,
            UpdateCategoryActionContract::class,
            PatchCategoryActionContract::class,
            DeleteCategoryActionContract::class,
            RestoreCategoryActionContract::class,
        ];
    }
}
