<?php

namespace PandaZoom\LaravelComment\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;
use PandaZoom\LaravelArticle\Http\Resources\ArticleResource;
use PandaZoom\LaravelArticle\Models\Article;
use PandaZoom\LaravelBase\Traits\HasResourceExtended;
use PandaZoom\LaravelUser\Http\Resources\UserResource;
use PandaZoom\LaravelUser\Models\User;

/**
 * @mixin \PandaZoom\LaravelComment\Models\Comment
 */
class CommentResource extends JsonResource
{
    use HasResourceExtended;

    public static $wrap = 'comment';

    protected array $availableInclude = [
        'article',
        'user',
    ];

    protected function getResourceData(): array
    {
        return [
            'id' => $this->id,
            'userId' => $this->user_id,
            'message' => $this->message,
            'createdAt' => $this->created_at?->toIso8601String(),
            'updatedAt' => $this->updated_at?->toIso8601String(),
        ];
    }

    protected function includeArticle(): MissingValue|ArticleResource
    {
        return $this->when(
            $this->relationLoaded('article')
            && $this->article instanceof Article,
            fn() => new ArticleResource($this->article)
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
}
