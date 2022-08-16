<?php

namespace App\Models;

use Eloquent;
use Illuminate\Support\Carbon;
use App\Models\Traits\Statusable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Question
 *
 * @property int         $id
 * @property string      $name
 * @property string      $email
 * @property string      $message
 * @property string      $seo_h1
 * @property string      $seo_title
 * @property string      $seo_description
 * @property string|null $answer
 * @property Carbon|null $answered_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int         $activity
 *
 * @mixin Eloquent
 */
class Question extends Model
{
    use Statusable;

    /**
     * @var string
     */
    protected $table = 'questions';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string[]
     */
    protected $casts = [
        'answered_at' => 'datetime'
    ];
}
