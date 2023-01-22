<?php

namespace PandaZoom\LaravelBase\Providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;
use function class_basename;
use function config;
use function config_path;
use function lang_path;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/common-api.php', 'common-api');

        Factory::guessFactoryNamesUsing(static fn ($class): string => 'Database\\Factories\\'.class_basename($class).'Factory');

        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        if (config('app.debug')) {
            $this->app->register(\Lanin\Laravel\ApiDebugger\ServiceProvider::class);
            $this->app->alias(\Lanin\Laravel\ApiDebugger\Debugger::class, 'Debugger');
        }
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../../config/common-api.php' => config_path('common-api.php'),
            ], 'base-config');

            $this->publishes([
                __DIR__.'/../../lang' => lang_path('vendor/laravel-base'),
            ], ['language', 'base-language']);
        }

        $this->loadTranslationsFrom(__DIR__.'/../../lang', 'base');
    }
}
