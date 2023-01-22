<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use PandaZoom\LaravelUser\Models\User;
use function class_exists;
use function database_path;
use function lang_path;

class_exists(RouteServiceProvider::class);
class_exists(RegisterServiceProvider::class);
class_exists(AuthServiceProvider::class);

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Relation::morphMap([
            'user' => User::class,
        ]);
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../lang' => lang_path('vendor/laravel-user'),
            ], ['languages', 'user-language']);

            $this->publishes([
                __DIR__.'/../../database/factories/' => database_path('/factories'),
                __DIR__.'/../../database/migrations/' => database_path('/migrations'),
                __DIR__.'/../../database/seeders/' => database_path('/seeders'),
            ], 'user-migrations');
        }

        $this->loadTranslationsFrom(__DIR__.'/../../lang', 'user');

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
