<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleTranslationCollection extends ResourceCollection
{
    public static $wrap = 'translations';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ArticleTranslationResource::collection($this->collection);
    }
}
