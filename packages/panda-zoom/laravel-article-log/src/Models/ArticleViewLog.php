<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticleLog\Models;

use Illuminate\Database\Eloquent\Casts\AsStringable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PandaZoom\LaravelArticle\Models\Article;
use PandaZoom\LaravelUser\Models\User;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampCreatedAtAttribute;
use function auth;
use function request;

class ArticleViewLog extends Model
{
    use HasTimestampCreatedAtAttribute;

    public const UPDATED_AT = null;

    protected $table = 'article_view_logs';

    protected $primaryKey = 'article_id';

    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'ip_address',
    ];

    protected $casts = [
        'article_id' => 'integer',
        'user_id' => 'integer',
        'ip_address' => AsStringable::class,
        'created_at' => 'immutable_datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(static function (self $model): void {
            $model->user_id = auth()->user()?->getAuthIdentifier();
            $model->ip_address = request()?->ip();
        });

        static::created(static function (self $model): void {
            $model->article()->increment('views');
        });
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'article_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
