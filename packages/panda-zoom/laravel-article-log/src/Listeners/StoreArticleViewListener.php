<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticleLog\Listeners;

use PandaZoom\LaravelArticle\Contracts\ArticleEventContract;
use PandaZoom\LaravelArticleLog\Jobs\StoreArticleViewJob;

class StoreArticleViewListener
{
    public function handle(ArticleEventContract $event): void
    {
        StoreArticleViewJob::dispatch($event->article);
    }
}
