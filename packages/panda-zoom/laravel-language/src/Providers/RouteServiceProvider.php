<?php
declare(strict_types=1);

namespace PandaZoom\LaravelLanguage\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use PandaZoom\LaravelBase\Http\Middleware\HeaderAcceptJson;
use PandaZoom\LaravelUserLocale\Middleware\AcceptLanguageFallback;
use function config;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->routes(function (): void {
            Route::prefix(config('common-api.api_prefix'))
                ->middleware([HeaderAcceptJson::class, AcceptLanguageFallback::class, 'api'])
                ->group(function (): void {
                    $this->loadRoutesFrom(__DIR__.'/../../routes/api.php');
                });
        });
    }
}
