<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCommentLog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PandaZoom\LaravelComment\Models\Comment;
use PandaZoom\LaravelUser\Models\User;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampCreatedAtAttribute;
use function auth;

class CommentMessageLog extends Model
{
    use HasTimestampCreatedAtAttribute;

    public const UPDATED_AT = null;

    protected $table = 'comment_message_logs';

    protected $primaryKey = 'comment_id';

    public $incrementing = false;

    protected $guarded = ['comment_id'];

    protected $casts = [
        'comment_id' => 'integer',
        'user_id' => 'integer',
        'message' => 'string',
        'created_at' => 'immutable_datetime',
    ];

    protected $visible = [
        'message',
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

    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class, $this->getKeyName(), 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
