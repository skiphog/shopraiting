<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Page
 *
 * @property int                    $id
 * @property string                 $slug
 * @property int                    $user_id
 * @property string                 $name
 * @property string                 $seo_h1
 * @property string                 $seo_title
 * @property string                 $seo_description
 * @property string|null            $before_content
 * @property string                 $content
 *
 * @property-read Collection|Shop[] $shops
 * @property-read int|null          $shops_count
 * @property-read User              $user
 */
class Page extends Model
{
    /**
     * @var string
     */
    protected $table = 'pages';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function shops(): BelongsToMany
    {
        return $this->belongsToMany(Shop::class, 'page_shop', 'page_id', 'shop_id');
    }
}
