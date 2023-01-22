<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUserLog\Listeners;

use PandaZoom\LaravelUser\Contracts\UserEventContract;
use PandaZoom\LaravelUserLog\Jobs\CreateUserFirstNameLogJob;

class UserFirstNameLogListener
{
    public function handle(UserEventContract $event): void
    {
        if (!$event->user->wasRecentlyCreated
            && ($event->user->isDirty('first_name') || $event->user->wasChanged('first_name'))) {
            CreateUserFirstNameLogJob::dispatchAfterResponse($event->user, $event->user->getOriginal('first_name'));
        }
    }
}
