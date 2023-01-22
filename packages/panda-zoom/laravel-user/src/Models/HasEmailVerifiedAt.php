<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Models;

use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampByTimezone;

/**
 * @mixin \PandaZoom\LaravelUser\Models\User
 */
trait HasEmailVerifiedAt
{
    use HasTimestampByTimezone;

    public function emailVerifiedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value): ?CarbonInterface => $this->getTimestampByTimezone($value),
            set: fn ($value): ?CarbonImmutable => $this->prepareTimestampByTzBeforeStore($value),
        );
    }
}
