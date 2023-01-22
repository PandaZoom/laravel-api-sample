<?php
declare(strict_types=1);

namespace PandaZoom\LaravelPassport\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RefreshToken extends Model
{
    use HasTimestampExpiresAt;

    /**
     * @inheritDoc
     */
    protected $table = 'oauth_refresh_tokens';

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
     */
    public $timestamps = false;

    /**
     * @inheritDoc
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'access_token_id',
        'revoked',
        'expires_at',
    ];

    /**
     * @inheritDoc
     */
    protected $casts = [
        'id' => 'string',
        'access_token_id' => 'string',
        'revoked' => 'bool',
        'expires_at' => 'immutable_datetime',
    ];

    public function token(): BelongsTo
    {
        return $this->belongsTo(Token::class, 'access_token_id', 'id');
    }
}
