<?php
declare(strict_types=1);

namespace PandaZoom\LaravelLanguageLog\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use PandaZoom\LaravelLanguage\Events\LanguageSaved;
use PandaZoom\LaravelLanguageLog\Listeners\LanguageActiveLogListener;
use function class_exists;

class_exists(LanguageSaved::class);
class_exists(LanguageActiveLogListener::class);

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array<class-string|string, array<int, class-string|string>>
     */
    protected $listen = [
        LanguageSaved::class => [
            LanguageActiveLogListener::class,
        ],
    ];
}
