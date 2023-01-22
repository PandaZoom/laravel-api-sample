<?php
declare(strict_types=1);

namespace PandaZoom\LaravelPassport\Models;

use Laravel\Passport\Token as PassportToken;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampCreatedAt;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampCreatedAtAttribute;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampUpdatedAt;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampUpdatedAtAttribute;

class Token extends PassportToken
{
    use HasTimestampCreatedAtAttribute;
    use HasTimestampUpdatedAtAttribute;
    use HasTimestampExpiresAt;

    /**
     * @inheritDoc
     */
    protected $table = 'oauth_access_tokens';

    /**
     * @inheritDoc
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'user_id',
        'client_id',
        'name',
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
        'name' => 'string',
        'scopes' => 'array',
        'revoked' => 'bool',
        'created_at' => 'immutable_datetime',
        'updated_at' => 'immutable_datetime',
        'expires_at' => 'immutable_datetime',
    ];
}
