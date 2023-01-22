<?php
declare(strict_types=1);

namespace PandaZoom\LaravelComment\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use PandaZoom\LaravelComment\Models\Comment;
use function base_path;
use function class_exists;
use function lang_path;

class_exists(Comment::class);
class_exists(RouteServiceProvider::class);
class_exists(RegisterServiceProvider::class);
class_exists(EventServiceProvider::class);
class_exists(AuthServiceProvider::class);

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Relation::morphMap([
            'comment' => Comment::class,
        ]);
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../lang' => lang_path('vendor/laravel-comment'),
            ], ['comment-language', 'languages']);

            $this->publishes([
                __DIR__ . '/../../database/factories/' => base_path('/database/factories'),
                __DIR__ . '/../../database/migrations/' => base_path('/database/migrations'),
            ], ['comment-migrations', 'migrations']);
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
            RouteServiceProvider::class,
            RegisterServiceProvider::class,
            AuthServiceProvider::class,
        ];
    }

    protected function bootProviders(): void
    {
        foreach ($this->provides() as $provider) {
            $this->app->register($provider);
        }
    }
}
