<?php

namespace App\Models;

use App\Models\Traits\Statusable;
use App\Models\Traits\Positioned;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Question
 *
 * @property int    $id
 * @property string $name
 * @property string $path
 * @property string $link
 * @property int    $activity
 * @property int    $position
 */
class Banner extends Model
{
    use Statusable, Positioned;

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
