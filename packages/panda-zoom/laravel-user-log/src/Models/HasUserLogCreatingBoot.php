<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUserLog\Models;

use function auth;

/**
 * @mixin \PandaZoom\LaravelUserLog\Models\UserActiveLog
 * @mixin \PandaZoom\LaravelUserLog\Models\UserEmailLog
 * @mixin \PandaZoom\LaravelUserLog\Models\UserFirstNameLog
 * @mixin \PandaZoom\LaravelUserLog\Models\UserLastNameLog
 * @mixin \PandaZoom\LaravelUserLog\Models\UserLocaleLog
 * @mixin \PandaZoom\LaravelUserLog\Models\UserTimezoneLog
 */
trait HasUserLogCreatingBoot
{
    protected static function bootHasUserLogCreatingBoot(): void
    {
        static::creating(static function (self $model): void {
            $model->editor_id = auth()->user()?->getAuthIdentifier();
        });
    }
}
