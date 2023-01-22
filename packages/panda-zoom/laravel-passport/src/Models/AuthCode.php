<?php
declare(strict_types=1);

namespace PandaZoom\LaravelPassport\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Passport\AuthCode as PassportAuthCode;
use PandaZoom\LaravelUser\Models\User;

class AuthCode extends PassportAuthCode
{
    use HasTimestampExpiresAt;

    protected $table = 'oauth_auth_codes';

    /**
     * @inheritDoc
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'user_id',
        'client_id',
        'scopes',
        'revoked',
        'expires_at',
    ];

    /**
     * @inheritDoc
     */
    protected $casts = [
        'id' => 'string',
        'user_id' => 'integer',
        'client_id' => 'integer',
        'scopes' => 'array',
        'revoked' => 'bool',
        'expires_at' => 'immutable_datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
