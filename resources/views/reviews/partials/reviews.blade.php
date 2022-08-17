<?php

/**
 * @var \App\Models\Review[] $reviews
*/

?>
@foreach($reviews as $review)
    <div class="review {{ $review->isNegative() ? '_border-color': '' }}" itemscope itemtype="https://schema.org/Review">
        <meta itemprop="itemReviewed" content="{{ $review->product->name }}">
        <div class="review__header">
            <a href="{{ route('shops.show', $review->product) }}" class="review__title">
                {{ $review->product->name }}
            </a>
            <div class="review__autor" itemprop="author" itemscope itemtype="https://schema.org/Person">
                <span itemprop="name">{{ $review->author_name }}</span>,
                {{ $review->created_at->format('d.m.Y') }}
            </div>
            <meta itemprop="datePublished" content="{{ $review->created_at->format('d.m.Y') }}">
        </div>
        <div class="review__text" itemprop="description">— {{ $review->content }}</div>
        <div class="review__footer">
            <div class="review__progress" itemscope itemtype="http://schema.org/AggregateRating">
                <meta itemprop="itemReviewed" content="{{ $review->product->name }}">
                <div class="stars">
                    <svg class="icon" width="20px" height="20px">
                        <use xlink:href="/img/sprite.svg#heart"></use>
                    </svg>
                    <svg class="icon" width="20px" height="20px">
                        <use xlink:href="/img/sprite.svg#heart"></use>
                    </svg>
                    <svg class="icon" width="20px" height="20px">
                        <use xlink:href="/img/sprite.svg#heart"></use>
                    </svg>
                    <svg class="icon" width="20px" height="20px">
                        <use xlink:href="/img/sprite.svg#heart"></use>
                    </svg>
                    <svg class="icon" width="20px" height="20px">
                        <use xlink:href="/img/sprite.svg#heart"></use>
                    </svg>
                    <div class="progress" style="width: {{ $review->rating_reverse }}%"></div>
                </div>
                <div itemprop="ratingValue" class="rating">{{ $review->rating_format }}</div>
                <meta itemprop="ratingCount" content="{{ $review->likes }}">
            </div>
            <div class="review__likes">
                <button type="button" class="review__likes-yes js-review-like" data-type="like"
                        data-review="{{ $review->id }}"
                        data-count="{{ $review->likes }}"></button>
            </div>
        </div>
    </div>
@endforeach