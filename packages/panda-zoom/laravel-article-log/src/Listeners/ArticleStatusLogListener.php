<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticleLog\Listeners;

use PandaZoom\LaravelArticle\Contracts\ArticleEventContract;
use PandaZoom\LaravelArticleLog\Jobs\CreateArticleStatusLogJob;

class ArticleStatusLogListener
{
    public function handle(ArticleEventContract $event): void
    {
        if (!$event->article->wasRecentlyCreated
            && ($event->article->isDirty('status_id') || $event->article->wasChanged('status_id'))) {
            CreateArticleStatusLogJob::dispatchAfterResponse($event->article, $event->article->getOriginal('status_id'));
        }
    }
}
