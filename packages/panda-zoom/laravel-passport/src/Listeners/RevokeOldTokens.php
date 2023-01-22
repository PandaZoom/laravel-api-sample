<?php
declare(strict_types=1);

namespace PandaZoom\LaravelPassport\Listeners;

use Laravel\Passport\Events\AccessTokenCreated;
use PandaZoom\LaravelPassport\Models\Token;

class RevokeOldTokens
{
    public function handle(AccessTokenCreated $event): void
    {
        Token::query()
            ->where('id', '<>', $event->tokenId)
            ->where('user_id', $event->userId)
            ->where('client_id', $event->clientId)
            ->update(['revoked' => true]);
    }
}
