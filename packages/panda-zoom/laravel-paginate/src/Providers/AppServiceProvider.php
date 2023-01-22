<?php
declare(strict_types=1);

namespace PandaZoom\LaravelPaginate\Providers;

use Illuminate\Support\ServiceProvider;
use function lang_path;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../lang' => lang_path('vendor/laravel-paginate'),
            ], ['languages', 'laravel-paginate-language']);
        }

        $this->loadTranslationsFrom(__DIR__.'/../../lang', 'paginate');
    }
}
