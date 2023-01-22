<?php
declare(strict_types=1);

namespace PandaZoom\LaravelLanguageLog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PandaZoom\LaravelBase\Traits\HasActiveScope;
use PandaZoom\LaravelLanguage\Models\Language;
use PandaZoom\LaravelUser\Models\User;
use function auth;

class LanguageActiveLog extends Model
{
    use HasActiveScope;

    public const UPDATED_AT = null;

    protected $table = 'language_active_logs';

    protected $primaryKey = 'lang_id';

    public $incrementing = false;

    protected $guarded = ['lang_id'];

    protected $casts = [
        'lang_id' => 'integer',
        'active' => 'boolean',
        'user_id' => 'integer',
        'created_at' => 'immutable_datetime',
    ];

    protected $attributes = [
        'active' => false,
    ];

    protected $visible = [
        'active',
        'user_id',
        'created_at',
    ];

    protected static function boot(): void
    {
        static::creating(static function (self $model): void {
            $model->user_id = auth()->user()?->getAuthIdentifier();
        });

        parent::boot();
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, $this->getKeyName(), 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
