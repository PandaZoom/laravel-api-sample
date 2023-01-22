<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCommentLog\Listeners;

use PandaZoom\LaravelComment\Contracts\CommentEventContract;
use PandaZoom\LaravelCommentLog\Jobs\CreateCommentMessageLogJob;

class CommentMessageLogListener
{
    public function handle(CommentEventContract $event): void
    {
        if (!$event->comment->wasRecentlyCreated
            && ($event->comment->isDirty('message') || $event->comment->wasChanged('message'))) {
            CreateCommentMessageLogJob::dispatchAfterResponse($event->comment, $event->comment->getOriginal('message'));
        }
    }
}
