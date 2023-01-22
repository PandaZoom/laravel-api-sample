<?php
declare(strict_types=1);

namespace PandaZoom\LaravelLanguage\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LanguageCollection extends ResourceCollection
{
    public static $wrap = 'languages';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return LanguageResource::collection($this->collection);
    }
}
