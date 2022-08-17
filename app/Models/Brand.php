<?php

namespace App\Models;

use Eloquent;
use Carbon\Carbon;
use App\Models\Traits\Ratings;
use App\Models\Traits\Statusable;
use App\Models\Traits\Positioned;
use App\Models\Traits\Reviewable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Brands
 *
 * @property int         $id
 * @property string      $name
 * @property string      $slug
 * @property string|null $img
 * @property string      $link
 * @property string|null $pixel
 * @property string      $seo_h1
 * @property string      $seo_title
 * @property string      $seo_description
 * @property string      description
 * @property string      $content
 * @property string      $country
 * @property float       $rating
 * @property float       $hack_rating
 * @property float       $rating_value
 * @property int         $rating_reverse
 * @property string      $rating_value_format
 * @property int         $position
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int         $activity
 * @mixin Eloquent
 * @method Builder|Brand positioned()
 * @property-read string $status_text
 */
class Brand extends Model
{
    use Reviewable, Statusable, Positioned, Ratings;

    /**
     * @var string
     */
    protected $table = 'brands';

    /**
     * @var array
     */
    protected $guarded = [];
}
