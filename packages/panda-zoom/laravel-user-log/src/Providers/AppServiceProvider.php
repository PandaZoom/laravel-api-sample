<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUserLog\Providers;

use Illuminate\Support\ServiceProvider;
use function class_exists;
use function database_path;

class_exists(EventServiceProvider::class);

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../database/migrations/' => database_path('/migrations'),
            ], 'user-log-migrations');
        }

        $this->bootProviders();
    }

    /**
     * @inheritDoc
     *
     * @return string[]
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
