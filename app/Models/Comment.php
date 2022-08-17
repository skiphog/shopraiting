<?php

namespace App\Models;

use Eloquent;
use Illuminate\Support\Carbon;
use App\Models\Traits\Statusable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
 * @property-read string         $first_letter_name
 * @mixin Eloquent
 */
class Comment extends Model
{
    use Statusable;

    /**
     * Допустимые цвета аватарок
     *
     * @var string[]
     */
    public static array $avatars = [
        'ava-green' => 'Зелёный',
        'ava-blue'  => 'Синий',
        'ava-red'   => 'Красный'
    ];

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

    /**
     * @return MorphTo
     */
    public function post(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return Attribute
     * @noinspection PhpUnused
     */
    protected function firstLetterName(): Attribute
    {
        return Attribute::make(
            get: static fn($value, $attributes) => mb_strtoupper(mb_substr($attributes['name'], 0, 1))
        );
    }
}
