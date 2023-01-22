<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Providers;

use Illuminate\Support\ServiceProvider;
use PandaZoom\LaravelStatus\Models\Status;
use function class_exists;
use function database_path;
use function lang_path;

class_exists(Status::class);
class_exists(RouteServiceProvider::class);
class_exists(RegisterServiceProvider::class);
class_exists(AuthServiceProvider::class);

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../lang' => lang_path('vendor/laravel-status'),
            ], ['status-language', 'languages']);

            $this->publishes([
                __DIR__ . '/../../database/migrations/' => database_path('/migrations'),
                __DIR__ . '/../../database/seeders/' => database_path('/seeders'),
            ], ['status-migrations', 'migrations']);
        }

        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'status');

        $this->bootProviders();
    }

    /**
     * @inheritDoc
     *
     * @return array<int, class-string|string>
     */
    public function provides(): array
    {
        return [
            ...parent::provides(),
            RouteServiceProvider::class,
            RegisterServiceProvider::class,
            AuthServiceProvider::class,
        ];
    }

    protected function bootProviders(): void
    {
        foreach ($this->provides() as $provider) {
            $this->app->register($provider);
        }
    }
}
