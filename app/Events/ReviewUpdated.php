<?php

namespace App\Events;

use App\Models\Review;
use Illuminate\Queue\SerializesModels;

class ReviewUpdated
{
    use SerializesModels;

    /**
     * @var Review
     */
    public Review $review;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Review $review)
    {
        $this->review = $review;
    }
}
