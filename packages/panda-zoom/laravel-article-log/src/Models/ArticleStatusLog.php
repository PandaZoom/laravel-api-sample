<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticleLog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PandaZoom\LaravelArticle\Models\Article;
use PandaZoom\LaravelStatus\Models\Status;
use PandaZoom\LaravelUser\Models\User;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampCreatedAtAttribute;

class ArticleStatusLog extends Model
{
    use HasTimestampCreatedAtAttribute;

    public const UPDATED_AT = null;

    protected $table = 'article_status_logs';

    protected $primaryKey = 'article_id';

    public $incrementing = false;

    protected $guarded = ['article_id'];

    protected $casts = [
        'article_id' => 'integer',
        'status_id' => 'integer',
        'user_id' => 'integer',
        'created_at' => 'immutable_datetime',
    ];

    protected $visible = [
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

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class, $this->getKeyName(), 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
}
