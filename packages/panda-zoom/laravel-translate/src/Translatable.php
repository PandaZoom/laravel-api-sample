<?php
declare(strict_types=1);

namespace PandaZoom\LaravelTranslate;

use Astrotomic\Translatable\Translatable as AstrotomicTranslatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use function array_unique;
use function config;

/**
 * Trait Translatable
 *
 * @package PandaZoom\LaravelTranslate
 * @property array $translatedAttributes
 * @property string|null $defaultLocale
 */
trait Translatable
{
    use AstrotomicTranslatable;

    public function translations(): HasMany
    {
        return $this->hasMany($this->getTranslationModelName(), $this->getTranslationRelationKey(),
            $this->getKeyName());
    }

    protected function getAllTranslationColumns(?array $columns): array
    {
        $columns = $columns ?? $this->translatedAttributes;
        $columns[] = $this->getTranslationRelationKey();
        $columns[] = config('translatable.locale_key', 'locale');

        return array_unique($columns);
    }

    public function scopeWithTranslation(Builder $query, array $columns = null): Builder
    {
        return $query->with([
            'translations' => function (HasMany $query) use ($columns): HasMany {

                $columns = $this->getAllTranslationColumns($columns);

                $query->addSelect($columns);

                if ($this->useFallback()) {
                    $locale = $this->locale();
                    $countryFallbackLocale = $this->getFallbackLocale($locale); // e.g. de-DE => de
                    $locales = array_unique([$locale, $countryFallbackLocale, $this->getFallbackLocale()]);

                    return $query->whereIn($this->getTranslationsTable() . '.' . $this->getLocaleKey(), $locales);
                }

                return $query->where($this->getTranslationsTable() . '.' . $this->getLocaleKey(), $this->locale());
            },
        ]);
    }
}
