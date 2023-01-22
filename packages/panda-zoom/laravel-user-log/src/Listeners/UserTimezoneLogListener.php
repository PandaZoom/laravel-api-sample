<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUserLog\Listeners;

use PandaZoom\LaravelUser\Contracts\UserEventContract;
use PandaZoom\LaravelUserLog\Jobs\CreateUserTimezoneLogJob;

class UserTimezoneLogListener
{
    public function handle(UserEventContract $event): void
    {
        if (!$event->user->wasRecentlyCreated
            && ($event->user->isDirty('timezone') || $event->user->wasChanged('timezone'))) {
            CreateUserTimezoneLogJob::dispatchAfterResponse($event->user, $event->user->getOriginal('timezone'));
        }
    }
}
