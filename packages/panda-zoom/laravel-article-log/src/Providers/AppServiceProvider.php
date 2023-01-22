<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticleLog\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use function base_path;
use function class_exists;

class_exists(EventServiceProvider::class);

class AppServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__ . '/../../database/migrations/' => base_path('/database/migrations'),
            ], ['article-log-migrations', 'migrations']);
        }

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
