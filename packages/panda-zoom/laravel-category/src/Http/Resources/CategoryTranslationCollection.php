<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryTranslationCollection extends ResourceCollection
{
    public static $wrap = 'translations';

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return CategoryTranslationResource::collection($this->collection);
    }
}
