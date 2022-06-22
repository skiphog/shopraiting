<?php

namespace App\Models;

use Eloquent;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Shop
 *
 * @property int         $id
 * @property string      $name
 * @property string      $slug
 * @property string|null $img
 * @property string      $link
 * @property string      $pixel
 * @property string      $advantage
 * @property string      $description
 * @property mixed       $contents
 * @property string      $content
 * @property float       $rating
 * @property float       $hack_rating
 * @property int         $position
 * @property int|null    $cities_cnt
 * @property int|null    $brands_cnt
 * @property int|null    $products_cnt
 * @property string|null $delivery_cost
 * @property string|null $delivery_time
 * @property string|null $discounts
 * @property string|null $founding_year
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int         $activity
 * @mixin Eloquent
 * @method Builder|Shop positioned()
 */
class Shop extends Model
{
    protected $table = 'shops';

    protected $casts = [
        'contents' => 'array'
    ];

    /**
     * @return void
     */
    protected static function booted(): void
    {
        static::addGlobalScope('activity', static function (Builder $builder) {
            $builder->where('activity', 1);
        });
    }

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
