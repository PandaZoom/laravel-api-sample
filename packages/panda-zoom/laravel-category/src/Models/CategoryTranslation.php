<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryTranslation extends Model
{
    protected $table = 'category_translations';

    protected $primaryKey = 'category_id';

    public $incrementing = false;

    public $timestamps = false;

    protected $visible = [
        'locale',
        'name',
    ];

    protected $fillable = [
        'locale',
        'name',
    ];

    protected $casts = [
        'category_id' => 'integer',
        'locale' => 'string',
        'name' => 'string',
    ];

    protected function setKeysForSaveQuery($query): Builder
    {
        return parent::setKeysForSaveQuery($query)
            ->where($this->qualifyColumn('locale'), $this->locale);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, $this->getKeyName(), 'id');
    }
}
