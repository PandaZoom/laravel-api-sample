<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCommentLog\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use PandaZoom\LaravelComment\Events\CommentSaved;
use PandaZoom\LaravelCommentLog\Listeners\CommentMessageLogListener;
use function class_exists;

class_exists(CommentSaved::class);
class_exists(CommentMessageLogListener::class);

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array<class-string|string, array<int, class-string|string>>
     */
    protected $listen = [
        CommentSaved::class => [
            CommentMessageLogListener::class,
        ],
    ];
}
