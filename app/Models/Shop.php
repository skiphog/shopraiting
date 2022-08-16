<?php

namespace App\Models;

use Eloquent;
use Illuminate\Support\Carbon;
use App\Models\Traits\Ratings;
use App\Models\Traits\Statusable;
use App\Models\Traits\Positioned;
use Illuminate\Support\Facades\DB;
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
 * @method Builder|Shop positioned()
 * @property-read string                $status_text
 * @property-read Review[]              $reviews
 * @property-read int|null              $reviews_count
 * @property-read Coupon[]              $coupons
 * @property-read int|null              $coupons_count
 * @property-read Collection|Category[] $categories
 * @property-read int|null              $categories_count
 */
class Shop extends Model
{
    use Statusable, Positioned, Ratings;

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
     * @return HasMany
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'shop_id', 'id');
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
     * @return array
     * @noinspection PhpUnused
     */
    public function getCounts(): array
    {
        $result = (array)DB::table('reviews')
            ->selectRaw(
                'count(*) cnt, 
                sum(rating < 3) cnt_1, 
                sum(rating >= 3 and rating < 5) cnt_2, 
                sum(rating >= 5 and rating < 7) cnt_3, 
                sum(rating >= 7 and rating < 9) cnt_4, 
                sum(rating >= 9) cnt_5'
            )
            ->where('shop_id', $this->id)
            ->where('activity', 1)
            ->first(1);

        $result['cnt'] = (int)$result['cnt'];
        $counts = [];
        for ($i = 5; $i > 0; $i--) {
            $counts[$i] = [
                'count'   => (int)$result["cnt_{$i}"],
                'percent' => $result['cnt'] ? ((int)$result["cnt_{$i}"] / $result['cnt']) * 100 : $result['cnt']
            ];
        }

        return $counts;
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
