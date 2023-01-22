<?php
declare(strict_types=1);

namespace PandaZoom\LaravelComment\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use PandaZoom\LaravelComment\Actions\CursorPaginateCommentAction;
use PandaZoom\LaravelComment\Actions\DeleteCommentAction;
use PandaZoom\LaravelComment\Actions\CreateArticleCommentAction;
use PandaZoom\LaravelComment\Actions\RestoreCommentAction;
use PandaZoom\LaravelComment\Actions\UpdateCommentAction;
use PandaZoom\LaravelComment\Contracts\CursorPaginateCommentActionContract;
use PandaZoom\LaravelComment\Contracts\DeleteCommentActionContract;
use PandaZoom\LaravelComment\Contracts\CreateArticleCommentActionContract;
use PandaZoom\LaravelComment\Contracts\RestoreCommentActionContract;
use PandaZoom\LaravelComment\Contracts\UpdateCommentActionContract;
use function class_exists;
use function interface_exists;

class_exists(CursorPaginateCommentAction::class);
class_exists(CreateArticleCommentAction::class);
class_exists(UpdateCommentAction::class);
class_exists(DeleteCommentAction::class);
class_exists(RestoreCommentAction::class);
interface_exists(CursorPaginateCommentActionContract::class);
interface_exists(DeleteCommentActionContract::class);
interface_exists(CreateArticleCommentActionContract::class);
interface_exists(RestoreCommentActionContract::class);
interface_exists(UpdateCommentActionContract::class);

class RegisterServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $this->app->singletonIf(CursorPaginateCommentActionContract::class, CursorPaginateCommentAction::class);
        $this->app->singletonIf(CreateArticleCommentActionContract::class, CreateArticleCommentAction::class);
        $this->app->singletonIf(UpdateCommentActionContract::class, UpdateCommentAction::class);
        $this->app->singletonIf(DeleteCommentActionContract::class, DeleteCommentAction::class);
        $this->app->singletonIf(RestoreCommentActionContract::class, RestoreCommentAction::class);
    }

    /**
     * @inheritDoc
     *
     * @return array<int, class-string|string>
     */
    public function provides(): array
    {
        return [
            CursorPaginateCommentActionContract::class,
            CreateArticleCommentActionContract::class,
            UpdateCommentActionContract::class,
            DeleteCommentActionContract::class,
            RestoreCommentActionContract::class,
        ];
    }
}
