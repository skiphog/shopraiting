<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\City
 *
 * @property int                    $id
 * @property string                 $name
 * @property string                 $slug
 * @property string                 $postcode
 * @property string                 $seo_h1
 * @property string                 $seo_title
 * @property string                 $seo_description
 * @property string|null            $before_content
 * @property string                 $content
 *
 * @property-read Collection|Shop[] $shops
 * @property-read int|null          $shops_count
 */
class City extends Model
{
    /**
     * @var string
     */
    protected $table = 'cities';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return BelongsToMany
     */
    public function shops(): BelongsToMany
    {
        return $this->belongsToMany(Shop::class, 'city_shop', 'city_id', 'shop_id');
    }
}
