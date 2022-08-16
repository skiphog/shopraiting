<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * @property int $position
 * @method Builder positioned()
 */
trait Positioned
{
    /**
     * @param Builder $query
     *
     * @return Builder
     * @noinspection PhpUnused
     */
    public function scopePositioned(Builder $query): Builder
    {
        return $query->orderBy('position');
    }
}
