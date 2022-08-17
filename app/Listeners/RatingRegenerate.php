<?php

namespace App\Listeners;

use App\Events\ReviewUpdated;

class RatingRegenerate
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param ReviewUpdated $event
     *
     * @return void
     * @noinspection PhpUndefinedFieldInspection
     */
    public function handle(ReviewUpdated $event): void
    {
        $event->review->product->update([
            'rating' => $event->review
                ->product
                ->loadAvg('reviews', 'rating')
                ->reviews_avg_rating ?: 0
        ]);
    }
}
