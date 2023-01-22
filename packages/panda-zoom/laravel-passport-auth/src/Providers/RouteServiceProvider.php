<?php
declare(strict_types=1);

namespace PandaZoom\LaravelPassportAuth\Providers;

use function config;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use PandaZoom\LaravelBase\Http\Middleware\HeaderAcceptJson;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        $this->routes(function (): void {

            Route::prefix(config('common-api.api_prefix'))
                ->middleware([HeaderAcceptJson::class, 'api'])
                ->group(function (): void {
                    $this->loadRoutesFrom(__DIR__.'/../../routes/api.php');
                });
        });
    }
}
