<?php

namespace App\Models;

use Eloquent;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * App\Models\Comment
 *
 * @property int                 $id
 * @property int                 $post_id
 * @property string              $post_type
 * @property string              $name
 * @property string              $email
 * @property string              $avatar_color
 * @property string              $message
 * @property string|null         $answer
 * @property Carbon|null         $answered_at
 * @property Carbon|null         $created_at
 * @property Carbon|null         $updated_at
 * @property int                 $activity
 * @property-read Model|Eloquent $post
 * @mixin Eloquent
 */
class Comment extends Model
{
    use Status;

    /**
     * @var string
     */
    protected $table = 'comments';

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

    public function post(): MorphTo
    {
        return $this->morphTo();
    }
}
