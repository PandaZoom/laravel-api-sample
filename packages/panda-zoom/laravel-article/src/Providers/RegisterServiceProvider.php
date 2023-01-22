<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use PandaZoom\LaravelArticle\Actions\CursorPaginateArticleAction;
use PandaZoom\LaravelArticle\Actions\DeleteArticleAction;
use PandaZoom\LaravelArticle\Actions\StoreArticleAction;
use PandaZoom\LaravelArticle\Actions\RestoreArticleAction;
use PandaZoom\LaravelArticle\Actions\UpdateArticleAction;
use PandaZoom\LaravelArticle\Actions\PatchArticleAction;
use PandaZoom\LaravelArticle\Actions\ShowArticleAction;
use PandaZoom\LaravelArticle\Contracts\CursorPaginateArticleActionContract;
use PandaZoom\LaravelArticle\Contracts\DeleteArticleActionContract;
use PandaZoom\LaravelArticle\Contracts\StoreArticleActionContract;
use PandaZoom\LaravelArticle\Contracts\RestoreArticleActionContract;
use PandaZoom\LaravelArticle\Contracts\UpdateArticleActionContract;
use PandaZoom\LaravelArticle\Contracts\PatchArticleActionContract;
use PandaZoom\LaravelArticle\Contracts\ShowArticleActionContract;
use function class_exists;
use function interface_exists;

class_exists(CursorPaginateArticleAction::class);
class_exists(StoreArticleAction::class);
class_exists(UpdateArticleAction::class);
class_exists(PatchArticleAction::class);
class_exists(DeleteArticleAction::class);
class_exists(RestoreArticleAction::class);
class_exists(ShowArticleAction::class);
interface_exists(CursorPaginateArticleActionContract::class);
interface_exists(DeleteArticleActionContract::class);
interface_exists(StoreArticleActionContract::class);
interface_exists(RestoreArticleActionContract::class);
interface_exists(UpdateArticleActionContract::class);
interface_exists(PatchArticleActionContract::class);
interface_exists(ShowArticleActionContract::class);

class RegisterServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->singletonIf(CursorPaginateArticleActionContract::class, CursorPaginateArticleAction::class);
        $this->app->singletonIf(StoreArticleActionContract::class, StoreArticleAction::class);
        $this->app->singletonIf(UpdateArticleActionContract::class, UpdateArticleAction::class);
        $this->app->singletonIf(PatchArticleActionContract::class, PatchArticleAction::class);
        $this->app->singletonIf(DeleteArticleActionContract::class, DeleteArticleAction::class);
        $this->app->singletonIf(RestoreArticleActionContract::class, RestoreArticleAction::class);
        $this->app->singletonIf(ShowArticleActionContract::class, ShowArticleAction::class);
    }

    /**
     * @inheritDoc
     *
     * @return array<int, class-string|string>
     */
    public function provides(): array
    {
        return [
            CursorPaginateArticleActionContract::class,
            StoreArticleActionContract::class,
            UpdateArticleActionContract::class,
            PatchArticleActionContract::class,
            DeleteArticleActionContract::class,
            RestoreArticleActionContract::class,
            ShowArticleActionContract::class,
        ];
    }
}
