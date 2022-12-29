<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class ShopFilter extends Filter
{
    /**
     * @var array $filters
     */
    protected array $filters = ['city'];

    /**
     * @param mixed $value
     *
     * @return Builder
     * @noinspection PhpUnused
     */
    protected function city(mixed $value): Builder
    {
        return $this->builder->whereRelation('cities', 'slug', $value);
    }
}
