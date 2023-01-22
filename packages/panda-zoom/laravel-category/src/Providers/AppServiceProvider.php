<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Providers;

use Illuminate\Support\ServiceProvider;
use function base_path;
use function class_exists;
use function lang_path;

class_exists(AuthServiceProvider::class);
class_exists(RouteServiceProvider::class);
class_exists(RegisterServiceProvider::class);

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__ . '/../../lang' => lang_path('vendor/laravel-category'),
            ], ['lang', 'category-languages']);

            $this->publishes([
                __DIR__ . '/../../database/factories/' => base_path('/database/factories'),
                __DIR__ . '/../../database/migrations/' => base_path('/database/migrations'),
                __DIR__ . '/../../database/seeders/' => base_path('/database/seeders'),
            ], ['migrations', 'category-migrations']);
        }

        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'category');

        $this->bootProviders();
    }

    /**
     * @inheritDoc
     * @return string[]
     */
    public function provides(): array
    {
        return [
            ...parent::provides(),
            AuthServiceProvider::class,
            RouteServiceProvider::class,
            RegisterServiceProvider::class,
        ];
    }

    protected function bootProviders(): void
    {
        foreach ($this->provides() as $provider) {
            $this->app->register($provider);
        }
    }
}
