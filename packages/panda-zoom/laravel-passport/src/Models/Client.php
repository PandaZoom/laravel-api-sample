<?php
declare(strict_types=1);

namespace PandaZoom\LaravelPassport\Models;

use Laravel\Passport\Client as PassportClient;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampCreatedAtAttribute;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampUpdatedAtAttribute;

class Client extends PassportClient
{
    use HasTimestampCreatedAtAttribute;
    use HasTimestampUpdatedAtAttribute;

    /**
     * @inheritDoc
     */
    protected $table = 'oauth_clients';

    /**
     * @inheritDoc
     */
    protected $keyType = 'string';

    /**
     * @inheritDoc
     */
    public $incrementing = false;

    /**
     * @inheritDoc
     *
     * @var string[]
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * @inheritDoc
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'name',
        'secret',
        'provider',
        'redirect',
        'personal_access_client',
        'password_client',
        'revoked',
    ];

    /**
     * @inheritDoc
     */
    protected $casts = [
        'id' => 'string',
        'user_id' => 'integer',
        'name' => 'string',
        'secret' => 'string',
        'provider' => 'string',
        'redirect' => 'string',
        'grant_types' => 'array',
        'personal_access_client' => 'bool',
        'password_client' => 'bool',
        'revoked' => 'bool',
        'created_at' => 'immutable_datetime',
        'updated_at' => 'immutable_datetime',
    ];
}
