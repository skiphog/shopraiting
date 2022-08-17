<?php

namespace App\Models\Traits;

use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property-read Review[] $reviews
 * @property-read int|null $reviews_count
 */
trait Reviewable
{
    /**
     * @noinspection PhpUnused
     */
    protected static function bootReviewable(): void
    {
        static::deleting(static fn($model) => $model->reviews->each->delete());
    }

    /**
     * @return MorphMany
     */
    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'post');
    }

    /**
     * @return array
     * @noinspection PhpUnused
     */
    public function getCounts(): array
    {
        $result = (array)DB::table('reviews')
            ->selectRaw(
                'count(*) cnt, 
                sum(rating < 3) cnt_1, 
                sum(rating >= 3 and rating < 5) cnt_2, 
                sum(rating >= 5 and rating < 7) cnt_3, 
                sum(rating >= 7 and rating < 9) cnt_4, 
                sum(rating >= 9) cnt_5'
            )
            ->where('post_id', $this->id)
            ->where('post_type', __CLASS__)
            ->where('activity', 1)
            ->first(1);

        $result['cnt'] = (int)$result['cnt'];
        $counts = [];
        for ($i = 5; $i > 0; $i--) {
            $counts[$i] = [
                'count'   => (int)$result["cnt_{$i}"],
                'percent' => $result['cnt'] ? ((int)$result["cnt_{$i}"] / $result['cnt']) * 100 : $result['cnt']
            ];
        }

        return $counts;
    }
}
