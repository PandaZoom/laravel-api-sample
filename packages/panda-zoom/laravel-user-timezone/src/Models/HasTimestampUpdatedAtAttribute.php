<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUserTimezone\Models;

use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * Trait HasTimestampUpdatedAtAttribute.
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 */
trait HasTimestampUpdatedAtAttribute
{
    use HasTimestampByTimezone;

    public function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value): ?CarbonInterface => $this->getTimestampByTimezone($value),
            set: fn ($value): ?CarbonImmutable => $this->prepareTimestampByTzBeforeStore($value),
        );
    }
}
