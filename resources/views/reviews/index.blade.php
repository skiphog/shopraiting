<?php

/**
 * @var \App\Models\Review[] $reviews
 * @var string               $current_slug
 */

?>
@extends('layouts.app')

@section('title', 'Реальные отзывы о секс шопах от покупателей')
@section('description', 'Честные отзывы от покупателей в интернет-магазинах секс шопах России')

@push('styles')
    <link rel="stylesheet" href="/css/select2.css">
    <link rel="stylesheet" href="/css/recall.css">
    <link rel="stylesheet" href="/css/case.css">
@endpush

@section('content')
    <main class="main">
        <div class="inner">
            <div class="wrap">
                @include('partials.breadcrumbs', ['data' => [['link' => '', 'title' => 'Отзывы']]])
                <h1>Отзывы о секс шопах от покупателей</h1>
                <div class="text">
                    <p>Здесь собраны отзывы пользователей о секс-шопах за 2018-2021 год. Отзывы оставлены как мужчинами,
                        так и женщинами. Вы можете оставить свой отзыв о любом секс-шопе через форму внизу страницы.</p>
                </div>
                <div class="content">
                    @include('partials.slider')
                    <div class="main-content">

                        <div class="recall inner__recall">
                            <div class="recall__box  _mini-style">
                                <div class="recall__header  _mini-style">
                                    <!--suppress HtmlFormInputWithoutLabel -->
                                    <select class="recall__header-select js-product-select">
                                        <option value="0">Все сексшопы</option>
                                        @foreach ($shops = \App\Models\Shop::getAllWithCache() as $shop)
                                            <option value="{{ $shop->slug }}" {{ $current_slug === $shop->slug ? 'selected': '' }}>
                                                {{ $shop->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="recall__header-box">
                                        @foreach ($shops->slice(0, \App\Models\Shop::MAX_SLIDER_SHOW) as $shop)
                                            <a href="#/reviews" class="recall__header-link">{{ $shop->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="recall__main-wrap">
                                    <div class="recall__main _mini-style">
                                        <button type="button"
                                                class="recall__main-link js-type-review _color__blue"
                                                data-type="all">
                                            Все отзывы
                                        </button>
                                        <button type="button"
                                                class="recall__main-link js-type-review _color__black"
                                                data-type="positive">
                                            Положительные отзывы
                                        </button>
                                        <button type="button"
                                                class="recall__main-link js-type-review _color__red"
                                                data-type="negative">
                                            Отрицательные отзывы
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @foreach($reviews as $review)
                                <div class="review {{ $review->isNegative() ? '_border-color': '' }}" itemscope itemtype="https://schema.org/Review">
                                    <meta itemprop="itemReviewed" content="{{ $review->shop->name }}">
                                    <div class="review__header">
                                        <a href="{{ route('shops.show', $review->shop) }}" class="review__title">{{ $review->shop->name }}</a>
                                        <div class="review__autor" itemprop="author" itemscope itemtype="https://schema.org/Person">
                                            <span itemprop="name">{{ $review->author_name }}</span>,
                                            {{ $review->created_at->format('d.m.Y') }}
                                        </div>
                                        <meta itemprop="datePublished" content="{{ $review->created_at->format('d.m.Y') }}">
                                    </div>
                                    <div class="review__text" itemprop="description">— {{ $review->content }}</div>
                                    <div class="review__footer">
                                        <div class="review__progress" itemscope itemtype="http://schema.org/AggregateRating">
                                            <meta itemprop="itemReviewed" content="{{ $review->shop->name }}">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="/js/reviews.js"></script>
@endpush