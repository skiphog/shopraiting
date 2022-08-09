<?php

namespace App\Models;

use Eloquent;
use DateTimeInterface;
use Illuminate\Support\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Coupon
 *
 * @property int         $id
 * @property int         $shop_id
 * @property string      $color
 * @property string      $type
 * @property string      $type_value
 * @property string      $type_content
 * @property string      $title
 * @property string      $content
 * @property string      $button_type
 * @property string      $button_content
 * @property Carbon      $start_at
 * @property Carbon      $end_at
 * @property Carbon|null $deleted_at
 * @property-read Shop   $shop
 * @method static Builder|Coupon onlyTrashed()
 * @method static Builder|Coupon withTrashed()
 * @method static Builder|Coupon withoutTrashed()
 * @mixin Eloquent
 */
class Coupon extends Model
{
    use SoftDeletes;

    /**
     * Цвет купона
     */
    public const COLORS = [
        'RED'    => 'red',
        'ORANGE' => 'orange',
        'GREEN'  => 'green',
        'BLUE'   => 'blue'
    ];

    /**
     * Тип купона
     */
    public const TYPES = [
        'PROMO' => 'promo',
        'STOCK' => 'stock'
    ];

    /**
     * Тип кнопки
     */
    public const BUTTON_TYPES = [
        'LINK'   => 'link',
        'COUPON' => 'coupon'
    ];

    /**
     * @var string
     */
    protected $table = 'coupons';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string[]
     */
    protected $casts = [
        'start_at' => 'datetime',
        'end_at'   => 'datetime',
    ];

    /**
     * Допустимые цвета
     *
     * @var string[]
     */
    public static array $colors = [
        'red'    => 'Красный',
        'orange' => 'Оранжевый',
        'green'  => 'Зелёный',
        'blue'   => 'Синий',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return string[]
     */
    public static function colorsList(): array
    {
        return [
            static::COLORS['RED']    => 'Красный',
            static::COLORS['ORANGE'] => 'Оранжевый',
            static::COLORS['GREEN']  => 'Зелёный',
            static::COLORS['BLUE']   => 'Синий',
        ];
    }

    /**
     * @return string[]
     */
    public static function typesList(): array
    {
        return [
            static::TYPES['PROMO'] => 'Промокод',
            static::TYPES['STOCK'] => 'Акция',
        ];
    }

    /**
     * @return string[]
     */
    public static function buttonTypesList(): array
    {
        return [
            static::BUTTON_TYPES['LINK']   => 'Ссылка',
            static::BUTTON_TYPES['COUPON'] => 'Купон',
        ];
    }

    /**
     * @return BelongsTo
     */
    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }

    /**
     * @return bool
     */
    public function isCoupon(): bool
    {
        return $this->button_type === static::BUTTON_TYPES['COUPON'];
    }

    /**
     * @return bool
     */
    public function isLink(): bool
    {
        return $this->button_type === static::BUTTON_TYPES['LINK'];
    }

    /**
     * @param DateTimeInterface $date
     *
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d\TH:i');
    }

    /**
     * @return Attribute
     * @noinspection PhpUnused
     */
    protected function typeValue(): Attribute
    {
        return Attribute::make(
            get: static fn($value, $attributes) => static::typesList()[$attributes['type']] ?? ''
        );
    }
}
