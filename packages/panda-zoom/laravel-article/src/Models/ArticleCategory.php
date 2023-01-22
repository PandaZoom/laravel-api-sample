<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use PandaZoom\LaravelCategory\Models\Category;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampCreatedAtAttribute;

class ArticleCategory extends Pivot
{
    use HasTimestampCreatedAtAttribute;

    public const UPDATED_AT = null;

    protected $table = 'article_category';

    protected $primaryKey = 'article_id';

    public $timestamps = false;

    protected $fillable = [
        'article_id',
        'category_id',
    ];

    protected $casts = [
        'article_id' => 'integer',
        'category_id' => 'integer',
    ];

    protected function setKeysForSaveQuery($query): Builder
    {
        return parent::setKeysForSaveQuery($query)
            ->where($this->qualifyColumn('category_id'), $this->category_id);
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class, $this->getKeyName(), 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
