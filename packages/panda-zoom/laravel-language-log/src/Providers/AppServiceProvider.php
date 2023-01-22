<?php
declare(strict_types=1);

namespace PandaZoom\LaravelLanguageLog\Providers;

use Illuminate\Support\ServiceProvider;
use function database_path;
use function class_exists;

class_exists(EventServiceProvider::class);

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../database/migrations/' => database_path('/migrations'),
            ], ['language-log-migrations', 'migrations']);
        }

        $this->bootProviders();
    }

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
