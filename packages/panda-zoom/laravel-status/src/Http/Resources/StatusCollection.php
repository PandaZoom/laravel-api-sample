<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StatusCollection extends ResourceCollection
{
    public static $wrap = 'statuses';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return StatusResource::collection($this->collection);
    }
}
