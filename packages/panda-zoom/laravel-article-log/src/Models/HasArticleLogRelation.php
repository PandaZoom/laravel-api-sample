<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticleLog\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasArticleLogRelation
{
    public function articleStatusLogs(): HasMany
    {
        return $this->hasMany(ArticleStatusLog::class, 'article_id', $this->getKeyName());
    }

    public function articleStatusLog(): HasOne
    {
        return $this->hasOne(ArticleStatusLog::class, 'article_id', $this->getKeyName());
    }

    public function articleViewLogs(): HasMany
    {
        return $this->hasMany(ArticleViewLog::class, 'article_id', 'id');
    }

    public function articleViewLog(): HasOne
    {
        return $this->hasOne(ArticleViewLog::class, 'article_id', 'id');
    }
}
