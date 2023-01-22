<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUserLog\Listeners;

use PandaZoom\LaravelUser\Contracts\UserEventContract;
use PandaZoom\LaravelUserLog\Jobs\CreateUserEmailLogJob;

class UserEmailLogListener
{
    public function handle(UserEventContract $event): void
    {
        if (!$event->user->wasRecentlyCreated
            && ($event->user->isDirty('email') || $event->user->wasChanged('email'))) {
            CreateUserEmailLogJob::dispatchAfterResponse($event->user, $event->user->getOriginal('email'));
        }
    }
}
