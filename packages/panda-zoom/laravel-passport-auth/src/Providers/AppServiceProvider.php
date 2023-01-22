<?php
declare(strict_types=1);

namespace PandaZoom\LaravelPassportAuth\Providers;

use function class_exists;
use Illuminate\Support\ServiceProvider;

class_exists(RouteServiceProvider::class);
class_exists(RegisterServiceProvider::class);

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
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
