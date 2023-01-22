<?php

namespace PandaZoom\LaravelBase\Traits;

use function defined;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait HasActiveScope.
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 *
 * @method static Builder|static active()
 * @method static Builder|static notActive()
 * @method static Builder|static ofActive(bool $enable = true)
 */
trait HasActiveScope
{
    public function scopeActive(Builder $query): Builder
    {
        return $query->where($this->getQualifiedActiveColumn(), 1);
    }

    public function scopeNotActive(Builder $query): Builder
    {
        return $query->where($this->getQualifiedActiveColumn(), 0);
    }

    public function scopeOfActive(Builder $query, bool $enable = true): Builder
    {
        return $query->where($this->getQualifiedActiveColumn(), (int) $enable);
    }

    public function getQualifiedActiveColumn(): string
    {
        return $this->qualifyColumn($this->getActiveColumn());
    }

    public function getActiveColumn(): string
    {
        return defined('static::ACTIVE') ? static::ACTIVE : 'active';
    }
}
