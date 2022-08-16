<?php

namespace App\Models\Traits;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property-read Comment[] $comments
 */
trait Commentable
{
    /**
     * @noinspection PhpUnused
     */
    protected static function bootCommentable(): void
    {
        static::deleting(static fn($model) => $model->comments->each->delete());
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'post');
    }
}
