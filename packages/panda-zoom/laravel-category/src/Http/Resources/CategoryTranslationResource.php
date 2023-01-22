<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use PandaZoom\LaravelBase\Traits\HasResourceExtended;

/**
 * @mixin \PandaZoom\LaravelCategory\Models\CategoryTranslation
 */
class CategoryTranslationResource extends JsonResource
{
    use HasResourceExtended;

    public static $wrap = 'translation';

    protected function getResourceData(): array
    {
        return $this->only(['locale', 'name']);
    }
}
