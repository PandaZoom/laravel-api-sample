<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;
use Illuminate\Support\Collection;
use PandaZoom\LaravelArticle\Models\ArticleTranslation;
use PandaZoom\LaravelBase\Traits\HasResourceExtended;
use PandaZoom\LaravelCategory\Http\Resources\CategoryCollection;
use PandaZoom\LaravelStatus\Http\Resources\StatusResource;
use PandaZoom\LaravelStatus\Models\Status;
use PandaZoom\LaravelUser\Http\Resources\UserResource;
use PandaZoom\LaravelUser\Models\User;

/**
 * @mixin \PandaZoom\LaravelArticle\Models\Article
 * @mixin \Astrotomic\Translatable\Contracts\Translatable
 * @mixin \PandaZoom\LaravelTranslate\Translatable
 */
class ArticleResource extends JsonResource
{
    use HasResourceExtended;

    public static $wrap = 'article';

    protected array $availableInclude = [
        'translations',
        'translation',
        'user',
        'status',
        'categories',
    ];

    protected function getResourceData(): array
    {
        return [
            'id' => $this->id,
            'userId' => $this->user_id,
            'statusId' => $this->status_id,
            'views' => $this->views,
            'createdAt' => $this->created_at?->toIso8601String(),
            'updatedAt' => $this->updated_at?->toIso8601String(),
            'title' => $this->whenNotNull($this->title),
            'description' => $this->whenNotNull($this->description),
            'name' => $this->whenNotNull($this->name),
            'summary' => $this->whenNotNull($this->summary),
            'story' => $this->whenNotNull($this->story),
        ];
    }

    protected function includeTranslations(): MissingValue|ArticleTranslationCollection
    {
        return $this->when(
            $this->relationLoaded('translations')
            && $this->translations instanceof Collection
            && $this->translations->isNotEmpty(),
            fn() => new ArticleTranslationCollection($this->translations)
        );
    }

    protected function includeTranslation(): MissingValue|ArticleTranslationResource
    {
        return $this->when(
            $this->relationLoaded('translation')
            && $this->translation instanceof ArticleTranslation,
            fn() => new ArticleTranslationResource($this->translation)
        );
    }

    protected function includeUser(): MissingValue|UserResource
    {
        return $this->when(
            $this->relationLoaded('user')
            && $this->user instanceof User,
            fn() => new UserResource($this->user)
        );
    }

    protected function includeStatus(): MissingValue|StatusResource
    {
        return $this->when(
            $this->relationLoaded('status')
            && $this->status instanceof Status,
            fn() => new StatusResource($this->status)
        );
    }

    protected function includeCategories(): MissingValue|CategoryCollection
    {
        return $this->when(
            $this->relationLoaded('categories')
            && $this->categories instanceof Collection
            && $this->categories->isNotEmpty(),
            fn() => new CategoryCollection($this->categories)
        );
    }
}
