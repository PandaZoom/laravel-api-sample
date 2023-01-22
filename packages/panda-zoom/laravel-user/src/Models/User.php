<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Models;

use App\Models\User as AppUser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use PandaZoom\LaravelArticle\Models\Article;
use PandaZoom\LaravelBase\Traits\HasActiveScope;
use PandaZoom\LaravelLanguage\Models\Language;
use PandaZoom\LaravelUser\Events\UserSaved;
use PandaZoom\LaravelUserLog\Models\UserActiveLog;
use PandaZoom\LaravelUserLog\Models\UserEmailLog;
use PandaZoom\LaravelUserLog\Models\UserFirstNameLog;
use PandaZoom\LaravelUserLog\Models\UserLastNameLog;
use PandaZoom\LaravelUserLog\Models\UserLocaleLog;
use PandaZoom\LaravelUserLog\Models\UserTimezoneLog;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampCreatedAtAttribute;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampDeletedAtAttribute;
use PandaZoom\LaravelUserTimezone\Models\HasTimestampUpdatedAtAttribute;
use PandaZoom\LaravelUserTimezone\Models\HasTimezoneAttribute;

class User extends AppUser
{
    use HasApiTokens;
    use SoftDeletes;
    use HasActiveScope;
    use HasTimestampCreatedAtAttribute;
    use HasTimestampUpdatedAtAttribute;
    use HasTimestampDeletedAtAttribute;
    use HasEmailVerifiedAt;
    use HasTimezoneAttribute;

    public const ACTIVE = 'active';

    protected $table = 'users';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'active',
        'locale',
        'timezone',
    ];

    protected $casts = [
        'id' => 'integer',
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'email_verified_at' => 'immutable_datetime',
        'password' => 'string',
        'remember_token' => 'string',
        'created_at' => 'immutable_datetime',
        'updated_at' => 'immutable_datetime',
        'deleted_at' => 'immutable_datetime',
        'active' => 'boolean',
        'locale' => 'string',
        'timezone' => 'string',
    ];

    protected $attributes = [
        'active' => true,
    ];

    protected $dispatchesEvents = [
        'saved' => UserSaved::class,
    ];

    public function userActiveLogs(): HasMany
    {
        return $this->hasMany(UserActiveLog::class, 'user_id', $this->getKeyName());
    }

    public function userActiveLog(): HasOne
    {
        return $this->hasOne(UserActiveLog::class, 'user_id', $this->getKeyName());
    }

    public function userEmailLogs(): HasMany
    {
        return $this->hasMany(UserEmailLog::class, 'user_id', $this->getKeyName());
    }

    public function userEmailLog(): HasOne
    {
        return $this->hasOne(UserEmailLog::class, 'user_id', $this->getKeyName());
    }

    public function userFirstNameLogs(): HasMany
    {
        return $this->hasMany(UserFirstNameLog::class, 'user_id', $this->getKeyName());
    }

    public function userFirstNameLog(): HasOne
    {
        return $this->hasOne(UserFirstNameLog::class, 'user_id', $this->getKeyName());
    }

    public function userLastNameLogs(): HasMany
    {
        return $this->hasMany(UserLastNameLog::class, 'user_id', $this->getKeyName());
    }

    public function userLastNameLog(): HasOne
    {
        return $this->hasOne(UserLastNameLog::class, 'user_id', $this->getKeyName());
    }

    public function userLocaleLogs(): HasMany
    {
        return $this->hasMany(UserLocaleLog::class, 'user_id', $this->getKeyName());
    }

    public function userLocaleLog(): HasOne
    {
        return $this->hasOne(UserLocaleLog::class, 'user_id', $this->getKeyName());
    }

    public function userTimezoneLogs(): HasMany
    {
        return $this->hasMany(UserTimezoneLog::class, 'user_id', $this->getKeyName());
    }

    public function userTimezoneLog(): HasOne
    {
        return $this->hasOne(UserTimezoneLog::class, 'user_id', $this->getKeyName());
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'user_id', $this->getKeyName());
    }

    public function article(): HasOne
    {
        return $this->hasOne(Article::class, 'user_id', $this->getKeyName());
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'locale', 'locale');
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function hasAdminRole(): bool
    {
        // :TODO: no any role / permission is implemented, just for demo return as `true`
        return true;
    }
}
