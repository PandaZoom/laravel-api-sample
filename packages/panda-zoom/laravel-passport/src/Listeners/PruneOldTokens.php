<?php
declare(strict_types=1);

namespace PandaZoom\LaravelPassport\Listeners;

use Laravel\Passport\Events\RefreshTokenCreated;
use PandaZoom\LaravelPassport\Models\RefreshToken;

class PruneOldTokens
{
    public function handle(RefreshTokenCreated $event): void
    {
        RefreshToken::where('id', '<>', $event->refreshTokenId)
            ->where('access_token_id', '<>', $event->accessTokenId)
            ->update(['revoked' => true]);
    }
}
