<?php

namespace App\Models;

use Eloquent;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
 * @property-read User   $user
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
     * Увеличить счётчик просмотров
     */
    public function updateView()
    {
        //return DB::table('articles')->where('id', $this->id)->increment('view');
        $this->timestamps = false;

        //return tap($this->update(['view' => $this->view + 1]), fn() => $this->timestamps = true);
        return tap($this->increment('view'), function () {
            $this->timestamps = true;
        });
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

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
