<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUserTimezone\Models;

use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * @mixin \Illuminate\Database\Eloquent\Model
 */
trait HasTimestampCreatedAtAttribute
{
    use HasTimestampByTimezone;

    public function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value): ?CarbonInterface => $this->getTimestampByTimezone($value),
            set: fn ($value): ?CarbonImmutable => $this->prepareTimestampByTzBeforeStore($value),
        );
    }
}
