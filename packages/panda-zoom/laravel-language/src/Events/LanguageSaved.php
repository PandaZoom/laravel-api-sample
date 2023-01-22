<?php
declare(strict_types=1);

namespace PandaZoom\LaravelLanguage\Events;

use Illuminate\Queue\SerializesModels;
use PandaZoom\LaravelLanguage\Contracts\LanguageEventContract;
use PandaZoom\LaravelLanguage\Models\Language;

class LanguageSaved implements LanguageEventContract
{
    use SerializesModels;

    public function __construct(public Language $language)
    {
        //
    }
}
