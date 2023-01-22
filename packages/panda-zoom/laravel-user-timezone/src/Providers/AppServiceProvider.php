<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUserTimezone\Providers;

use function base_path;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../../database/migrations/' => base_path('/database/migrations'),
            ], 'timezone-migrations');
        }

        Date::use(CarbonImmutable::class);
    }
}
