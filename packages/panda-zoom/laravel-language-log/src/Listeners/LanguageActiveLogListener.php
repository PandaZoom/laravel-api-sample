<?php
declare(strict_types=1);

namespace PandaZoom\LaravelLanguageLog\Listeners;

use PandaZoom\LaravelLanguage\Contracts\LanguageEventContract;
use PandaZoom\LaravelLanguageLog\Jobs\CreateLanguageActiveLogJob;

class LanguageActiveLogListener
{
    public function handle(LanguageEventContract $event): void
    {
        if ($event->language->isDirty('active') || $event->language->wasChanged('active')) {
            CreateLanguageActiveLogJob::dispatchAfterResponse($event->language, $event->language->getOriginal('active', false));
        }
    }
}
