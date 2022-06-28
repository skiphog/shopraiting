<?php

namespace App\Filters;

use App\Models\Review;
use Illuminate\Database\Eloquent\Builder;

class ReviewFilter extends Filter
{
    /**
     * @var array $filters
     */
    protected array $filters = ['rating'];

    /**
     * @var string[]
     */
    protected array $ratingFilters = [
        'negative' => '<=',
        'positive' => '>'
    ];

    /**
     * @param mixed $value
     *
     * @return Builder
     * @noinspection PhpUnused
     */
    protected function rating(mixed $value): Builder
    {
        return $this
            ->builder
            ->where(
                'rating',
                $this->ratingFilters[$value] ?? '>',
                Review::MAX_NEGATIVE_RATING
            );
    }
}
