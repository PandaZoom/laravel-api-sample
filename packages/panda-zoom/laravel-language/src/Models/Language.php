<?php
declare(strict_types=1);

namespace PandaZoom\LaravelLanguage\Models;

use Illuminate\Database\Eloquent\Casts\AsStringable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use PandaZoom\LaravelBase\Traits\HasActiveScope;
use PandaZoom\LaravelLanguage\Events\LanguageSaved;
use PandaZoom\LaravelLanguageLog\Models\LanguageActiveLog;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampCreatedAtAttribute;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampDeletedAtAttribute;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampUpdatedAtAttribute;

class Language extends Model
{
    use HasActiveScope;
    use HasTimestampCreatedAtAttribute;
    use HasTimestampUpdatedAtAttribute;
    use HasTimestampDeletedAtAttribute;

    public const ACTIVE = 'active';

    protected $table = 'languages';

    protected $hidden = ['position'];

    protected $visible = ['id', 'name', 'active'];

    protected $fillable = ['locale', 'name', 'active', 'position'];

    protected $guarded = ['id'];

    protected $casts = [
        'id' => 'integer',
        'locale' => AsStringable::class,
        'name' => AsStringable::class,
        'active' => 'boolean',
        'position' => 'integer',
        'created_at' => 'immutable_datetime',
        'updated_at' => 'immutable_datetime',
        'deleted_at' => 'immutable_datetime',
    ];

    protected $dispatchesEvents = [
        'saved' => LanguageSaved::class,
    ];

    public function languageActiveLogs(): HasMany
    {
        return $this->hasMany(LanguageActiveLog::class, 'lang_id', $this->getKeyName());
    }

    public function languageActiveLog(): HasOne
    {
        return $this->hasOne(LanguageActiveLog::class, 'lang_id', $this->getKeyName());
    }
}
