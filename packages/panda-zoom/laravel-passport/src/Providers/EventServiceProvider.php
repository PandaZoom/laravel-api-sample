<?php
declare(strict_types=1);

namespace PandaZoom\LaravelPassport\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Laravel\Passport\Events\AccessTokenCreated;
use Laravel\Passport\Events\RefreshTokenCreated;
use PandaZoom\LaravelPassport\Listeners\PruneOldTokens;
use PandaZoom\LaravelPassport\Listeners\RevokeOldTokens;
use function class_exists;

class_exists(RevokeOldTokens::class);
class_exists(PruneOldTokens::class);

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [

        AccessTokenCreated::class => [
            RevokeOldTokens::class,
        ],

        RefreshTokenCreated::class => [
            PruneOldTokens::class,
        ],
    ];
}
