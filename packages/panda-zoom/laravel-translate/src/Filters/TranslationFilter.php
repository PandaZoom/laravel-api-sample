<?php
declare(strict_types=1);

namespace Sevenpluss\LaravelTranslate\Filters;

use Illuminate\Support\Collection;
use Illuminate\Support\Traits\Macroable;
use function config;
use function in_array;

class TranslationFilter
{
    use Macroable;

    public static function translations(array $data): Collection
    {
        return (new Collection($data))
            ->filter(static fn(array $data, string $locale): bool => in_array($locale,
                    config('translatable.locales'), true) && !empty($data['name']) && !empty($data['summary']));
    }
}
