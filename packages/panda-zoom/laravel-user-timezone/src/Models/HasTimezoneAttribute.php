<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUserTimezone\Models;

use function config;
use Illuminate\Database\Eloquent\Casts\Attribute;
use function is_null;

/**
 * Trait HasTimezone
 * Accessors & Mutators.
 * Should be placed to User model.
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 */
trait HasTimezoneAttribute
{
    public function timezone(): Attribute
    {
        return Attribute::make(
            get: static fn ($value): ?string => $value == config('app.timezone') || empty($value) ? config('app.timezone') : $value,
            set: static fn ($value): ?string => $value == config('app.timezone') || is_null($value) ? null : $value,
        );
    }
}
