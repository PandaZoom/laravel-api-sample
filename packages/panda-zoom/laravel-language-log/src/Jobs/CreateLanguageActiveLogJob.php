<?php
declare(strict_types=1);

namespace PandaZoom\LaravelLanguageLog\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PandaZoom\LaravelLanguage\Models\Language;
use Throwable;

class CreateLanguageActiveLogJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $tries = 1;

    public function __construct(protected Language $language, protected bool $active)
    {
        //
    }

    public function handle(): void
    {
        try {
            $this->language->languageActiveLogs()->create([
                'active' => $this->active,
            ]);
        } catch (Throwable) {
        }
    }
}
