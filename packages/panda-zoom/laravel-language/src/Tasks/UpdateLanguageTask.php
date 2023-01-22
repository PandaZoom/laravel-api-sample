<?php
declare(strict_types=1);

namespace PandaZoom\LaravelLanguage\Tasks;

use PandaZoom\LaravelLanguage\Models\Language;

class UpdateLanguageTask
{
    public function run(Language $language, array $attributes): bool
    {
        return $language->update($attributes);
    }

    public function runUpdateOrFail(Language $language, array $attributes): bool
    {
        return $language->updateOrFail($attributes);
    }
}
