<?php
declare(strict_types=1);

namespace PandaZoom\LaravelPassport\Models;

use Laravel\Passport\PersonalAccessClient as PassportPersonalAccessClient;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampCreatedAtAttribute;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampUpdatedAtAttribute;

class PersonalAccessClient extends PassportPersonalAccessClient
{
    use HasTimestampCreatedAtAttribute;
    use HasTimestampUpdatedAtAttribute;

    /**
     * @inheritDoc
     */
    protected $table = 'oauth_personal_access_clients';

    /**
     * @inheritDoc
     *
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @inheritDoc
     *
     * @var string[]
     */
    protected $fillable = ['client_id'];

    /**
     * @inheritDoc
     */
    protected $casts = [
        'id' => 'integer',
        'client_id' => 'string',
        'created_at' => 'immutable_datetime',
        'updated_at' => 'immutable_datetime',
    ];
}
