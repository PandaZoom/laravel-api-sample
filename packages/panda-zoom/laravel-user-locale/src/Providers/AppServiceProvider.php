<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUserLocale\Providers;

use function base_path;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../../database/migrations/' => base_path('/database/migrations'),
            ], 'user-locale-migrations');
        }
    }
}
