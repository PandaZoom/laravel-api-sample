<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;
use Illuminate\Support\Collection;
use PandaZoom\LaravelArticle\Http\Resources\ArticleCollection;
use PandaZoom\LaravelArticle\Http\Resources\ArticleResource;
use PandaZoom\LaravelArticle\Models\Article;
use PandaZoom\LaravelBase\Traits\HasResourceExtended;
use PandaZoom\LaravelUser\Http\Resources\UserResource;
use PandaZoom\LaravelUser\Models\User;

/**
 * @mixin \PandaZoom\LaravelStatus\Models\Status
 */
class StatusResource extends JsonResource
{
    use HasResourceExtended;

    public static $wrap = 'status';

    protected array $availableInclude = [
        'user',
        'article',
        'articles',
    ];

    protected function getResourceData(): array
    {
        return [
            'id' => $this->id,
            'userId' => $this->user_id,
            'slug' => $this->slug,
            'createdAt' => $this->created_at?->toIso8601String(),
            'updatedAt' => $this->updated_at?->toIso8601String(),
            'deletedAt' => $this->deleted_at?->toIso8601String(),
        ];
    }

    protected function includeUser(): MissingValue|UserResource
    {
        return $this->when(
            $this->relationLoaded('user')
            && $this->user instanceof User,
            fn() => new UserResource($this->user)
        );
    }

    protected function includeArticle(): MissingValue|ArticleResource
    {
        return $this->when(
            $this->relationLoaded('article')
            && $this->article instanceof Article,
            fn() => new ArticleResource($this->article)
        );
    }

    protected function includeCategories(): MissingValue|ArticleCollection
    {
        return $this->when(
            $this->relationLoaded('articles')
            && $this->articles instanceof Collection
            && $this->articles->isNotEmpty(),
            fn() => new ArticleCollection($this->articles)
        );
    }
}
