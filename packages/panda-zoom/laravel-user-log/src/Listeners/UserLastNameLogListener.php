<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUserLog\Listeners;

use PandaZoom\LaravelUser\Contracts\UserEventContract;
use PandaZoom\LaravelUserLog\Jobs\CreateUserLastNameLogJob;

class UserLastNameLogListener
{
    public function handle(UserEventContract $event): void
    {
        if (!$event->user->wasRecentlyCreated
            && ($event->user->isDirty('last_name') || $event->user->wasChanged('last_name'))) {
            CreateUserLastNameLogJob::dispatchAfterResponse($event->user, $event->user->getOriginal('last_name'));
        }
    }
}
