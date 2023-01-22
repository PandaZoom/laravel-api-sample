<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCommentLog\Providers;

use Illuminate\Support\ServiceProvider;
use PandaZoom\LaravelComment\Models\Comment;
use function base_path;
use function class_exists;

class_exists(Comment::class);
class_exists(EventServiceProvider::class);

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__ . '/../../database/migrations/' => base_path('/database/migrations'),
            ], ['comment-log-migrations', 'migrations']);
        }

        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'comment');

        $this->bootProviders();
    }

    /**
     * @inheritDoc
     *
     * @return array<int, class-string|string>
     */
    public function provides(): array
    {
        return [
            ...parent::provides(),
            EventServiceProvider::class,
        ];
    }

    protected function bootProviders(): void
    {
        foreach ($this->provides() as $provider) {
            $this->app->register($provider);
        }
    }
}
