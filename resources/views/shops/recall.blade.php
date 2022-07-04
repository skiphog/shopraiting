<?php

/**
 * @var \App\Models\Review[] $reviews
*/

?>
<div class="product">
    <div class="product__choose">
        <div class="product__choose-box">
            <button type="button"
                    class="product__choose-link _color__blue js-review-type {{ !request('rating') ? 'active' : '' }}"
                    data-link="{{ request()->url() }}">Все отзывы</button>
            <button type="button"
                    class="product__choose-link _color__black js-review-type {{ request('rating') === 'positive' ? 'active' : '' }}"
                    data-link="{{ request()->url() . '?rating=positive' }}">Положительные отзывы</button>
            <button type="button"
                    class="product__choose-link _color__red js-review-type {{ request('rating') === 'negative' ? 'active' : '' }}"
                    data-link="{{ request()->url() . '?rating=negative' }}">Отрицательные отзывы</button>
        </div>
    </div>
    <div class="recall inner__recall">
        @include('reviews.partials.reviews', compact('reviews'))
    </div>
</div>

{{ $reviews->onEachSide(1)->links('partials.paginate') }}