<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use PandaZoom\LaravelCategory\Models\Category;
use PandaZoom\LaravelCategory\Policies\CategoryPolicy;
use function class_exists;

class_exists(CategoryPolicy::class);

class AuthServiceProvider extends ServiceProvider
{
    /**
     * @inheritDoc
     */
    protected $policies = [
        Category::class => CategoryPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::resource('category', CategoryPolicy::class);
    }
}
