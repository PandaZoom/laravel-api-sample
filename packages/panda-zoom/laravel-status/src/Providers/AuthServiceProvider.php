<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use PandaZoom\LaravelStatus\Models\Status;
use PandaZoom\LaravelStatus\Policies\StatusPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<string|class-string, string|class-string>
     */
    protected $policies = [
        Status::class => StatusPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::resource('status', StatusPolicy::class);
    }
}
