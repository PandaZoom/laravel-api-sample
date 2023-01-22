<?php
declare(strict_types=1);

namespace PandaZoom\LaravelLanguage\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use PandaZoom\LaravelBase\Traits\HasResourceExtended;

/**
 * @mixin \PandaZoom\LaravelLanguage\Models\Language
 */
class LanguageResource extends JsonResource
{
    use HasResourceExtended;

    public static $wrap = 'language';

    protected function getResourceData(): array
    {
        return [
            'id' => $this->id,
            'locale' => $this->locale,
            'name' => $this->name,
            'active' => $this->active,
        ];
    }
}
