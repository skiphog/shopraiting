<?php

namespace App\Models;

use Eloquent;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Article
 *
 * @property int         $id
 * @property int         $user_id
 * @property string      $name
 * @property string      $slug
 * @property string|null $img
 * @property string      $intro
 * @property array       $contents
 * @property string      $before_content
 * @property string      $content
 * @property string      $seo_h1
 * @property string      $seo_title
 * @property string      $seo_description
 * @property int         $view
 * @property int         $time_to_read
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int         $activity
 * @mixin Eloquent
 */
class Article extends Model
{
    /**
     * @var string
     */
    protected $table = 'articles';

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
     * @return void
     */
    protected static function booted(): void
    {
        static::addGlobalScope('activity', static function (Builder $builder) {
            $builder->where('activity', 1);
        });
    }
}
