<?php

namespace App\Models;

use Eloquent;
use App\Models\Traits\Statusable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Question
 *
 * @property int    $id
 * @property string $name
 * @property string $path
 * @property string $link
 * @property int    $activity
 *
 * @mixin Eloquent
 */
class Banner extends Model
{
    use Statusable;

    /**
     * @var string
     */
    protected $table = 'banners';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var bool
     */
    public $timestamps = false;
}
