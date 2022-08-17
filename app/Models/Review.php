<?php

namespace App\Models;

use Eloquent;
use App\Filters\ReviewFilter;
use App\Events\ReviewUpdated;
use Illuminate\Support\Carbon;
use App\Models\Traits\Statusable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * App\Models\Review
 *
 * @property int             $id
 * @property int             $post_id
 * @property string          $post_type
 * @property float           $rating
 * @property int             $rating_reverse
 * @property string          $rating_format
 * @property int             $likes
 * @property string          $author_name
 * @property string          $author_email
 * @property string          $content
 * @property Carbon|null     $created_at
 * @property Carbon|null     $updated_at
 * @property int             $activity
 * @mixin Eloquent
 * @method Builder       filter($filter)
 * @property-read Shop|Brand $post
 */
class Review extends Model
{
    use Statusable;

    /**
     * Рейтинг, который считается негативным.
     * Всё, что выше - позитивный
     */
    public const MAX_NEGATIVE_RATING = 5;

    /**
     * @var string
     */
    protected $table = 'reviews';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string[]
     */
    protected $dispatchesEvents = [
        'updated' => ReviewUpdated::class,
        'deleted' => ReviewUpdated::class
    ];

    /**
     * @return bool
     */
    public function isNegative(): bool
    {
        return $this->rating <= static::MAX_NEGATIVE_RATING;
    }

    /**
     * Добавить лайк к отзыву
     */
    public function like()
    {
        $this->timestamps = false;

        return tap($this->increment('likes'), function () {
            $this->timestamps = true;
        });
    }

    /**
     * @param Builder      $builder
     * @param ReviewFilter $filter
     *
     * @return Builder
     * @noinspection PhpUnused
     */
    public function scopeFilter(Builder $builder, ReviewFilter $filter): Builder
    {
        return $filter->apply($builder);
    }

    /**
     * @return MorphTo
     */
    public function post(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return Attribute
     * @noinspection PhpUnused
     */
    protected function ratingFormat(): Attribute
    {
        return Attribute::make(
            get: fn() => number_format($this->rating, 1, ',', ' ')
        );
    }

    /**
     * @return Attribute
     * @noinspection PhpUnused
     */
    protected function ratingReverse(): Attribute
    {
        return Attribute::make(
            get: fn() => (int)(100 - $this->rating * 10)
        );
    }
}
