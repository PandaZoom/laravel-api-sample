<?php

namespace PandaZoom\LaravelCategory\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;
use Illuminate\Support\Collection;
use PandaZoom\LaravelArticle\Http\Resources\ArticleCollection;
use PandaZoom\LaravelBase\Traits\HasResourceExtended;
use PandaZoom\LaravelCategory\Models\CategoryTranslation;

/**
 * @mixin \PandaZoom\LaravelCategory\Models\Category
 */
class CategoryResource extends JsonResource
{
    use HasResourceExtended;

    public static $wrap = 'category';

    protected array $availableInclude = [
        'translations',
        'translation',
        'articles',
    ];

    protected function getResourceData(): array
    {
        return [
            'id' => $this->id,
            'active' => $this->active,
            'position' => $this->position,
            'name' => $this->whenNotNull($this->name),
            'createdAt' => $this->created_at?->toIso8601String(),
            'updatedAt' => $this->updated_at?->toIso8601String(),
        ];
    }

    protected function includeTranslations(): MissingValue|CategoryTranslationCollection
    {
        return $this->when(
            $this->relationLoaded('translations')
            && $this->translations instanceof Collection
            && $this->translations->isNotEmpty(),
            fn() => new CategoryTranslationCollection($this->translations)
        );
    }

    protected function includeTranslation(): MissingValue|CategoryTranslationResource
    {
        return $this->when(
            $this->relationLoaded('translation')
            && $this->translation instanceof CategoryTranslation,
            fn() => new CategoryTranslationResource($this->translation)
        );
    }

    protected function includeArticles(): MissingValue|ArticleCollection
    {
        return $this->when(
            $this->relationLoaded('articles')
            && $this->articles instanceof Collection
            && $this->articles->isNotEmpty(),
            fn() => new ArticleCollection($this->articles)
        );
    }
}
