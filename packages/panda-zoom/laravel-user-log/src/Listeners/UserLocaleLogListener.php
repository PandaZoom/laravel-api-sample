<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUserLog\Listeners;

use PandaZoom\LaravelUser\Contracts\UserEventContract;
use PandaZoom\LaravelUserLog\Jobs\CreateUserLocaleLogJob;

class UserLocaleLogListener
{
    public function handle(UserEventContract $event): void
    {
        if (!$event->user->wasRecentlyCreated
            && ($event->user->isDirty('locale') || $event->user->wasChanged('locale'))) {
            CreateUserLocaleLogJob::dispatchAfterResponse($event->user, $event->user->getOriginal('locale'));
        }
    }
}
