<?php

namespace PandaZoom\LaravelComment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use PandaZoom\LaravelComment\Events\CommentSaved;
use PandaZoom\LaravelArticle\Models\Article;
use PandaZoom\LaravelUser\Models\User;
use PandaZoom\LaravelCommentLog\Models\CommentMessageLog;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampCreatedAtAttribute;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampDeletedAtAttribute;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampUpdatedAtAttribute;
use function auth;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasTimestampCreatedAtAttribute;
    use HasTimestampUpdatedAtAttribute;
    use HasTimestampDeletedAtAttribute;

    protected $table = 'comments';

    protected $fillable = [
        'message',
    ];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'message' => 'string',
        'created_at' => 'immutable_datetime',
        'updated_at' => 'immutable_datetime',
        'deleted_at' => 'immutable_datetime',
    ];

    protected $dispatchesEvents = [
        'saved' => CommentSaved::class,
    ];

    protected static function boot(): void
    {
        static::creating(static function (self $model): void {
            $model->user_id = auth()->user()?->getAuthIdentifier();
        });

        parent::boot();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function commentMessageLogs(): HasMany
    {
        return $this->hasMany(CommentMessageLog::class, 'comment_id', $this->getKeyName());
    }

    public function commentMessageLog(): HasOne
    {
        return $this->hasOne(CommentMessageLog::class, 'comment_id', $this->getKeyName());
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'commentable_type', 'commentable_id');
    }

    public function article(): MorphTo
    {
        return $this->morphTo(Article::class, 'commentable');
    }
}
