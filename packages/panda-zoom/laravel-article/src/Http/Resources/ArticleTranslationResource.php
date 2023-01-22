<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use PandaZoom\LaravelBase\Traits\HasResourceExtended;

/**
 * @mixin \PandaZoom\LaravelArticle\Models\ArticleTranslation
 */
class ArticleTranslationResource extends JsonResource
{
    use HasResourceExtended;

    public static $wrap = 'translation';

    protected function getResourceData(): array
    {
        return [
            'articleId' => $this->article_id,
            'locale' => $this->locale,
            'title' => $this->title,
            'description' => $this->description,
            'name' => $this->name,
            'summary' => $this->summary,
            'story' => $this->story,
        ];
    }
}
