<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsStringable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArticleTranslation extends Model
{
    protected $table = 'article_translations';

    protected $primaryKey = 'article_id';

    public $incrementing = false;

    public $timestamps = false;

    protected $guarded = ['article_id'];

    protected $fillable = [
        'locale',
        'title',
        'description',
        'name',
        'summary',
        'story',
    ];

    protected $casts = [
        'article_id' => 'integer',
        'locale' => AsStringable::class,
        'title' => 'string',
        'description' => 'string',
        'name' => 'string',
        'summary' => 'string',
        'story' => 'string',
    ];

    /**
     * Set the keys for a save update query.
     *
     * @param  Builder  $query
     * @return Builder
     */
    protected function setKeysForSaveQuery($query): Builder
    {
        return parent::setKeysForSaveQuery($query)
            ->where('locale', $this->locale);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Article::class, $this->getKeyName(), 'id');
    }
}
