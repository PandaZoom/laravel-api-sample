<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUserLog\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use PandaZoom\LaravelUser\Events\UserSaved;
use PandaZoom\LaravelUserLog\Listeners\UserActiveLogListener;
use PandaZoom\LaravelUserLog\Listeners\UserEmailLogListener;
use PandaZoom\LaravelUserLog\Listeners\UserFirstNameLogListener;
use PandaZoom\LaravelUserLog\Listeners\UserLastNameLogListener;
use PandaZoom\LaravelUserLog\Listeners\UserLocaleLogListener;
use PandaZoom\LaravelUserLog\Listeners\UserTimezoneLogListener;
use function class_exists;

class_exists(UserSaved::class);
class_exists(UserActiveLogListener::class);
class_exists(UserEmailLogListener::class);
class_exists(UserFirstNameLogListener::class);
class_exists(UserLastNameLogListener::class);
class_exists(UserLocaleLogListener::class);
class_exists(UserTimezoneLogListener::class);

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array<class-string|string, array<int, class-string|string>>
     */
    protected $listen = [
        UserSaved::class => [
            UserActiveLogListener::class,
            UserEmailLogListener::class,
            UserFirstNameLogListener::class,
            UserLastNameLogListener::class,
            UserLocaleLogListener::class,
            UserTimezoneLogListener::class,
        ],
    ];
}
