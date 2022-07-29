<?php

namespace App\Models;

use Eloquent;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Article
 *
 * @property int         $id
 * @property int         $user_id
 * @property string      $name
 * @property string      $slug
 * @property string|null $img
 * @property string      $intro
 * @property array       $contents
 * @property string      $before_content
 * @property string      $content
 * @property string      $seo_h1
 * @property string      $seo_title
 * @property string      $seo_description
 * @property int         $view
 * @property int         $time_to_read
 * @property int         $star_count
 * @property int         $star_sum
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int         $activity
 * @mixin Eloquent
 * @property-read User   $user
 * @property-read string $status_text
 * @property-read int    $rating
 * @property-read string $rating_format
 */
class Article extends Model
{
    /**
     * Статус статьи
     */
    public const STATUS = [
        'INACTIVE' => 0,
        'ACTIVE'   => 1
    ];

    /**
     * @var string
     */
    protected $table = 'articles';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string[]
     */
    protected $casts = [
        'contents' => 'array'
    ];

    /**
     * Статусы статей
     *
     * @return string[]
     */
    public static function statusList(): array
    {
        return [
            static::STATUS['INACTIVE'] => 'Неактивный',
            static::STATUS['ACTIVE']   => 'Активный'
        ];
    }

    /**
     * Увеличить счётчик просмотров
     */
    public function updateView()
    {
        //return DB::table('articles')->where('id', $this->id)->increment('view');
        $this->timestamps = false;

        //return tap($this->update(['view' => $this->view + 1]), fn() => $this->timestamps = true);
        return tap($this->increment('view'), function () {
            $this->timestamps = true;
        });
    }

    public function setVote(int $value)
    {
        $this->timestamps = false;

        return tap(
            $this->update(['star_count' => $this->star_count + 1, 'star_sum' => $this->star_sum + $value]),
            function () {
                $this->timestamps = true;
            }
        );
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return Attribute
     * @noinspection PhpUnused
     */
    protected function statusText(): Attribute
    {
        return Attribute::make(
            get: static fn($value, $attributes) => static::statusList()[$attributes['activity']] ?? ''
        );
    }

    /**
     * @return Attribute
     * @noinspection PhpUnused
     */
    protected function rating(): Attribute
    {
        return Attribute::make(
            get: static fn($value, $attributes) => $attributes['star_sum'] / $attributes['star_count']
        );
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
     * @return void
     */
    protected static function booted(): void
    {
        static::addGlobalScope('activity', static function (Builder $builder) {
            $builder->where('activity', 1);
        });
    }
}
