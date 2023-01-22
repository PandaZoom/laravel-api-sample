<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticleLog\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use PandaZoom\LaravelArticle\Events\ArticleShown;
use PandaZoom\LaravelArticleLog\Listeners\StoreArticleViewListener;
use PandaZoom\LaravelArticleLog\Listeners\ArticleStatusLogListener;
use PandaZoom\LaravelArticle\Events\ArticleSaved;
use function class_exists;

class_exists(ArticleSaved::class);
class_exists(ArticleStatusLogListener::class);

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array<class-string|string, array<int, class-string|string>>
     */
    protected $listen = [
        ArticleSaved::class => [
            ArticleStatusLogListener::class,
        ],
        ArticleShown::class => [
            StoreArticleViewListener::class
        ],
    ];
}
