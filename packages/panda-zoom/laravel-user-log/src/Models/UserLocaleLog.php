<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUserLog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PandaZoom\LaravelUser\Models\User;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampCreatedAtAttribute;

class UserLocaleLog extends Model
{
    use HasTimestampCreatedAtAttribute;
    use HasUserLogCreatingBoot;

    public const UPDATED_AT = null;

    protected $table = 'user_locale_logs';

    protected $primaryKey = 'user_id';

    public $incrementing = false;

    protected $guarded = ['user_id'];

    protected $casts = [
        'user_id' => 'integer',
        'locale' => 'string',
        'editor_id' => 'integer',
        'created_at' => 'immutable_datetime',
    ];

    protected $visible = [
        'locale',
        'editor_id',
        'created_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, $this->getKeyName(), 'id');
    }

    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'editor_id', 'id');
    }
}
