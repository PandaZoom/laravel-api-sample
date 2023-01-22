<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Models;

use Astrotomic\Translatable\Contracts\Translatable as ContractsTranslatable;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use PandaZoom\LaravelArticle\Events\ArticleSaved;
use PandaZoom\LaravelArticleLog\Models\HasArticleLogRelation;
use PandaZoom\LaravelCategory\Models\Category;
use PandaZoom\LaravelComment\Models\Comment;
use PandaZoom\LaravelStatus\Models\Status;
use PandaZoom\LaravelTranslate\Translatable;
use PandaZoom\LaravelUser\Models\User;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampCreatedAtAttribute;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampDeletedAtAttribute;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampUpdatedAtAttribute;

/**
 * @property-read string $title
 * @property-read string|null $description
 * @property-read string $name
 * @property-read string|null $summary
 * @property-read string|null $story
 */
class Article extends Model implements ContractsTranslatable
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;
    use HasArticleLogRelation;
    use HasTimestampCreatedAtAttribute;
    use HasTimestampUpdatedAtAttribute;
    use HasTimestampDeletedAtAttribute;

    public string $translationModel = ArticleTranslation::class;
    public string $translationForeignKey = 'article_id';
    public array $translatedAttributes = ['title', 'description', 'name', 'summary', 'story'];

    protected $table = 'articles';

    protected $fillable = [
        'user_id',
        'status_id',
        'views',
        'published_at',
        'expires_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'status_id' => 'integer',
        'views' => 'integer',
        'published_at' => 'immutable_datetime',
        'expires_at' => 'immutable_datetime',
        'created_at' => 'immutable_datetime',
        'updated_at' => 'immutable_datetime',
        'deleted_at' => 'immutable_datetime',
    ];

    protected $attributes = [
        'views' => 0,
    ];

    protected $dispatchesEvents = [
        'saved' => ArticleSaved::class,
    ];

    protected static function boot(): void
    {
        static::creating(static function (self $model): void {
            $model->user_id = auth()->user()?->getAuthIdentifier();
        });

        parent::boot();
    }

    public function publishedAt(): Attribute
    {
        return Attribute::make(
            get: fn($value): ?CarbonInterface => $this->getTimestampByTimezone($value),
            set: fn($value): ?CarbonImmutable => $this->prepareTimestampByTzBeforeStore($value),
        );
    }

    public function expiresAt(): Attribute
    {
        return Attribute::make(
            get: fn($value): ?CarbonInterface => $this->getTimestampByTimezone($value),
            set: fn($value): ?CarbonImmutable => $this->prepareTimestampByTzBeforeStore($value),
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            'article_category',
            'article_id',
            'category_id',
            'id',
            'id')
            ->as('articleCategory')
            ->using(ArticleCategory::class);
    }
}
