<?php
declare(strict_types=1);

namespace PandaZoom\LaravelPassport\Providers;

use Illuminate\Support\ServiceProvider;
use function base_path;
use function class_exists;
use function database_path;

class_exists(AuthServiceProvider::class);
class_exists(EventServiceProvider::class);

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../../config/passport.php' => config_path('passport.php'),
            ], 'passport-config');

            $this->publishes([
                __DIR__.'/../../database/seeders/' => database_path('/seeders'),
                __DIR__.'/../../database/migrations/' => base_path('/database/migrations'),
            ], 'passport-migrations');
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
            AuthServiceProvider::class,
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
