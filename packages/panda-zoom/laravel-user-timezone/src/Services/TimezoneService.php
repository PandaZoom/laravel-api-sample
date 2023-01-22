<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUserTimezone\Services;

use function auth;
use Carbon\CarbonImmutable;
use function config;

class TimezoneService
{
    public static function getUserTimezone(): string
    {
        return auth()->user()?->timezone ?? config('app.timezone');
    }

    /**
     * @param  \DateTimeInterface|\Carbon\CarbonInterface|string|null  $value
     * @return CarbonImmutable|null
     */
    public static function serverTimestamp($value): ?CarbonImmutable
    {
        return $value !== null
            ? CarbonImmutable::parse($value)->setTimezone(config('app.timezone'))
            : null;
    }
}
