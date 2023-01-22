<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use PandaZoom\LaravelArticle\Models\Article;
use PandaZoom\LaravelArticle\Policies\ArticlePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<string|class-string, string|class-string>
     */
    protected $policies = [
        Article::class => ArticlePolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::resource('article', ArticlePolicy::class);
    }
}
