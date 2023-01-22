<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUserLog\Listeners;

use PandaZoom\LaravelUser\Contracts\UserEventContract;
use PandaZoom\LaravelUserLog\Jobs\CreateUserActiveLogJob;

class UserActiveLogListener
{
    public function handle(UserEventContract $event): void
    {
        if (!$event->user->wasRecentlyCreated
            && ($event->user->isDirty('active') || $event->user->wasChanged('active'))) {
            CreateUserActiveLogJob::dispatchAfterResponse($event->user, $event->user->getOriginal('active', false));
        }
    }
}
