<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * @property float  $rating_value
 * @property string $rating_value_format
 * @property int    $rating_reverse
 */
trait Ratings
{
    /**
     * @return Attribute
     * @noinspection PhpUnused
     */
    protected function ratingValue(): Attribute
    {
        return Attribute::make(
            get: static function ($value, $attributes) {
                return !empty($attributes['hack_rating']) && $attributes['hack_rating'] > 0
                    ? $attributes['hack_rating']
                    : $attributes['rating'];
            }
        );
    }

    /**
     * @return Attribute
     * @noinspection PhpUnused
     */
    protected function ratingValueFormat(): Attribute
    {
        return Attribute::make(
            get: fn() => number_format($this->rating_value, 1, ',', ' ')
        );
    }

    /**
     * @return Attribute
     * @noinspection PhpUnused
     */
    protected function ratingReverse(): Attribute
    {
        return Attribute::make(
            get: fn() => (int)(100 - $this->rating_value * 10)
        );
    }
}
