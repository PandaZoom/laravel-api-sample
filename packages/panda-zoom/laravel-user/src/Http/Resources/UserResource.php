<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;
use Illuminate\Support\Collection;
use PandaZoom\LaravelArticle\Http\Resources\ArticleCollection;
use PandaZoom\LaravelArticle\Http\Resources\ArticleResource;
use PandaZoom\LaravelArticle\Models\Article;
use PandaZoom\LaravelBase\Traits\HasResourceExtended;
use PandaZoom\LaravelLanguage\Http\Resources\LanguageResource;
use PandaZoom\LaravelLanguage\Models\Language;

/**
 * @mixin \PandaZoom\LaravelUser\Models\User
 */
class UserResource extends JsonResource
{
    use HasResourceExtended;

    public static $wrap = 'user';

    protected array $availableInclude = [
        'language',
        'articles',
        'article',
    ];

    protected function getResourceData(): array
    {
        return [
            'id' => $this->id,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'locale' => $this->locale,
            'timezone' => $this->timezone,
        ];
    }

    protected function includeLanguage(): MissingValue|LanguageResource
    {
        return $this->when(
            $this->relationLoaded('language')
            && $this->language instanceof Language,
            fn() => new LanguageResource($this->language)
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

    protected function includeArticle(): MissingValue|ArticleResource
    {
        return $this->when(
            $this->relationLoaded('article')
            && $this->article instanceof Article,
            fn() => new ArticleResource($this->article)
        );
    }
}
