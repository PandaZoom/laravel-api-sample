<?php
declare(strict_types=1);

namespace PandaZoom\LaravelPassport\Models;

use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampByTimezone;

/**
 * @mixin \Illuminate\Database\Eloquent\Model
 */
trait HasTimestampExpiresAt
{
    use HasTimestampByTimezone;

    public function expiresAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value): ?CarbonInterface => $this->getTimestampByTimezone($value),
            set: fn ($value): ?CarbonImmutable => $this->prepareTimestampByTzBeforeStore($value),
        );
    }
}
