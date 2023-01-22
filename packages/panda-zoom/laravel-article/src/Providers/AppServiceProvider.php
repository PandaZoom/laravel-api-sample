<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use PandaZoom\LaravelArticle\Models\Article;
use function base_path;
use function class_exists;
use function lang_path;

class_exists(Article::class);
class_exists(RouteServiceProvider::class);
class_exists(RegisterServiceProvider::class);
class_exists(AuthServiceProvider::class);

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Relation::morphMap([
            'article' => Article::class,
        ]);
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../lang' => lang_path('vendor/laravel-article'),
            ], ['article-language', 'languages']);

            $this->publishes([
                __DIR__ . '/../../database/factories/' => base_path('/database/factories'),
                __DIR__ . '/../../database/migrations/' => base_path('/database/migrations'),
                __DIR__ . '/../../database/seeders/' => base_path('/database/seeders'),
            ], ['article-migrations', 'migrations']);
        }

        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'article');

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
