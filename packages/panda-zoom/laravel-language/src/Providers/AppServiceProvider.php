<?php
declare(strict_types=1);

namespace PandaZoom\LaravelLanguage\Providers;

use Illuminate\Support\ServiceProvider;
use function class_exists;
use function database_path;
use function lang_path;

class_exists(RouteServiceProvider::class);

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../lang' => lang_path('vendor/laravel-language'),
            ], ['lang', 'language-lang']);

            $this->publishes([
                __DIR__.'/../../database/migrations/' => database_path('/migrations'),
            ], ['language-migrations', 'migrations']);

            $this->publishes([
                __DIR__.'/../../database/seeders/' => database_path('/seeders'),
                __DIR__.'/../../database/data/' => database_path('/data'),
            ], ['language-seeds', 'seeds']);
        }

        $this->loadTranslationsFrom(__DIR__.'/../../lang', 'language');

        $this->bootProviders();
    }

    public function provides(): array
    {
        return [
            ...parent::provides(),
            RouteServiceProvider::class,
        ];
    }

    protected function bootProviders(): void
    {
        foreach ($this->provides() as $provider) {
            $this->app->register($provider);
        }
    }
}
