<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use PandaZoom\LaravelArticle\Models\Article;
use PandaZoom\LaravelArticle\Models\ArticleCategory;
use PandaZoom\LaravelBase\Traits\HasActiveScope;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampCreatedAtAttribute;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampDeletedAtAttribute;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampUpdatedAtAttribute;

/**
 * @property-read string $name
 */
class Category extends Model implements TranslatableContract
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;
    use HasActiveScope;
    use HasTimestampCreatedAtAttribute;
    use HasTimestampUpdatedAtAttribute;
    use HasTimestampDeletedAtAttribute;

    public string $translationModel = CategoryTranslation::class;
    public string $translationForeignKey = 'category_id';
    public array $translatedAttributes = ['name'];

    protected $table = 'categories';

    protected $perPage = 20;

    protected $visible = [
        'id',
        'active',
        'position',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'active',
        'position',
    ];

    protected $casts = [
        'id' => 'integer',
        'active' => 'boolean',
        'position' => 'integer',
        'created_at' => 'immutable_datetime',
        'updated_at' => 'immutable_datetime',
        'deleted_at' => 'immutable_datetime',
    ];

    protected $attributes = [
        'active' => false,
        'position' => 0,
        'deleted_at'=> null,
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(CategoryTranslation::class, 'category_id', $this->getKeyName());
    }

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(
            Article::class,
            'article_category',
            'category_id',
            'article_id',
            'id',
            'id'
        )
            ->as('articleCategory')
            ->using(ArticleCategory::class);
    }
}
