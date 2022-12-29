<?php

namespace App\Models;

use Eloquent;
use App\Filters\ShopFilter;
use Illuminate\Support\Carbon;
use App\Models\Traits\Ratings;
use App\Models\Traits\Statusable;
use App\Models\Traits\Positioned;
use App\Models\Traits\Reviewable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Shop
 *
 * @property int                        $id
 * @property string                     $name
 * @property string                     $slug
 * @property string|null                $img
 * @property string                     $link
 * @property string                     $pixel
 * @property string                     $seo_h1
 * @property string                     $seo_title
 * @property string                     $seo_description
 * @property string                     $seo_h1_reviews
 * @property string                     $seo_title_reviews
 * @property string                     $seo_description_reviews
 * @property string                     $advantage
 * @property string                     $description
 * @property mixed                      $contents
 * @property string                     $content
 * @property float                      $rating
 * @property float                      $hack_rating
 * @property float                      $rating_value
 * @property int                        $rating_reverse
 * @property string                     $rating_value_format
 * @property int                        $position
 * @property int|null                   $cities_cnt
 * @property int|null                   $brands_cnt
 * @property int|null                   $products_cnt
 * @property string                     $products_cnt_format
 * @property string|null                $delivery_cost
 * @property string|null                $delivery_time
 * @property string|null                $discounts
 * @property string|null                $founding_year
 * @property Carbon|null                $created_at
 * @property Carbon|null                $updated_at
 * @property int                        $activity
 * @mixin Eloquent
 * @method Builder|Shop                 positioned()
 * @method Builder                      filter($filter)
 * @property-read string                $status_text
 * @property-read Review[]              $reviews
 * @property-read int|null              $reviews_count
 * @property-read Coupon[]              $coupons
 * @property-read int|null              $coupons_count
 * @property-read Collection|Category[] $categories
 * @property-read string                $type_text
 */
class Shop extends Model
{
    use Reviewable, Statusable, Positioned, Ratings;

    /**
     * Сколько магазинов показывать на главной странице
     */
    public const MAX_MAIN_SHOW = 5;

    /**
     * Сколько магазинов показывать в мини-слайдере
     */
    public const MAX_SLIDER_SHOW = 3;

    /**
     * @var string
     */
    protected $table = 'shops';

    /**
     * @var string
     */
    protected string $type_text = 'Магазин';

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
     * Удалить весь кеш, связанный с магазинами
     *
     * @return void
     */
    public static function flushAllCache(): void
    {
        foreach (['menu', 'shops', 'slider'] as $item) {
            Cache::forget($item);
        }
    }

    /**
     * @return static[]
     *
     * @noinspection PhpMissingReturnTypeInspection
     * @noinspection ReturnTypeCanBeDeclaredInspection
     * @noinspection PhpUnused
     */
    public static function getAllWithCache()
    {
        return Cache::rememberForever('shops', static function () {
            return static::select(['id', 'slug', 'name'])
                ->positioned()
                ->get();
        });
    }

    /**
     * @param Builder    $builder
     * @param ShopFilter $filter
     *
     * @return Builder
     * @noinspection PhpUnused
     */
    public function scopeFilter(Builder $builder, ShopFilter $filter): Builder
    {
        return $filter->apply($builder);
    }

    /**
     * @return HasMany
     */
    public function coupons(): HasMany
    {
        return $this->hasMany(Coupon::class, 'shop_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_shop', 'shop_id', 'category_id');
    }

    /**
     * @return BelongsToMany
     */
    public function cities(): BelongsToMany
    {
        return $this->belongsToMany(City::class, 'city_shop', 'shop_id', 'city_id');
    }

    /**
     * @return string
     * @noinspection PhpUnused
     */
    public function getRoutShow(): string
    {
        return route('shops.show', $this);
    }

    /**
     * @return Attribute
     * @noinspection PhpUnused
     */
    protected function ProductsCntFormat(): Attribute
    {
        return Attribute::make(
            get: fn() => number_format((float)$this->products_cnt, 0, '', ' ')
        );
    }
}
