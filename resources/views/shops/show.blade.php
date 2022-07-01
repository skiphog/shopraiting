<?php

/**
 * @var \App\Models\Shop $shop
 */

?>
@extends('layouts.app')

@section('title', "Секс шоп «{$shop->name}» – честный обзор, отзывы, акции и скидки")
@section('description', "Секс шоп «{$shop->name}» – информация о компании, ассортимент товаров, как получить скидку, варианты оплаты, способы доставки, контакты магазинов и отзывы!")

@push('styles')
    <link rel="stylesheet" href="/css/sidebar.css">
    <link rel="stylesheet" href="/css/plus.css">
    <link rel="stylesheet" href="/css/banner.css">
    <link rel="stylesheet" href="/css/text.css">
    <link rel="stylesheet" href="/css/recall.css">
    <link rel="stylesheet" href="/css/product.css">
    <link rel="stylesheet" href="/css/case.css">
@endpush

@section('content')
    <main class="main">
        <div class="inner-back">
            <div class="wrap">
                @include('partials.breadcrumbs', ['data' => [['link' => route('shops.index'), 'title' => 'Магазины'], ['link' => '', 'title' => $shop->name]]])
                <h1>Секс шоп «{{ $shop->name }}» отзывы</h1>
                <div class="content">
                    <aside class="sidebar">
                        <div class="sidebar__item overview__sidebar-item sticky-sidebar__item">
                            <div class="sidebar__slider-item">
                                <a target="_blank" href="{{ url($shop->pixel) }}" data-goal="click-{{ $shop->slug }}" class="sidebar__slider-img">
                                    <picture>
                                        <img src="{{ $shop->img }}" alt="{{ $shop->name }}">
                                    </picture>
                                </a>
                                <a href="{{ route('shops.show', $shop) }}" class="sidebar__slider-name">{{ $shop->name }}</a>
                                <div class="sidebar__progress" itemscope itemtype="https://schema.org/AggregateRating">
                                    <meta itemprop="itemReviewed" content="{{ $shop->name }}">
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
                                        <svg class="icon" width="20px" height="20">
                                            <use xlink:href="/img/sprite.svg#heart"></use>
                                        </svg>
                                        <div class="progress" style="width: {{ $shop->rating_reverse }}%"></div>
                                    </div>
                                    <div itemprop="ratingValue" class="rating">{{ $shop->rating_value_format }}</div>
                                    <meta itemprop="ratingCount" content="{{ $shop->reviews_count }}">
                                </div>
                                <a href="{{ url($shop->pixel) }}" data-goal="click-{{ $shop->slug }}" class="sidebar__slider-action" target="_blank">Перейти на сайт</a>
                            </div>
                        </div>
                    </aside>
                    <div class="main-content">
                        <div class="plus">
                            <div class="plus__header">
                                <div class="plus__header-item">
                                    <div class="plus__header-line">Официальный сайт</div>
                                    <a href="{{ url($shop->pixel) }}" data-goal="click-{{ $shop->slug }}"
                                            target='_blank' class="plus__header-link">{{ $shop->link }}</a>
                                </div>
                                <div class="plus__header-item">
                                    @if(!empty($shop->founding_year))
                                        <div class="plus__header-line">Год основания</div>
                                        <div class="plus__header-title">{{ $shop->founding_year }} год</div>
                                    @endif
                                </div>
                                <div class="plus__header-item">
                                    <div class="plus__header-line">Отзывов</div>
                                    <a href="#/reviews" class="plus__header-link">
                                        {{ $shop->reviews_count }} {{ trans_choice('dic.review', $shop->reviews_count) }}
                                    </a>
                                </div>
                            </div>
                            <div class="plus__main">
                                @if (!empty($shop->cities_cnt))
                                    <div class="plus__main-item">
                                        <svg class="icon" width="40px" height="40px">
                                            <use xlink:href="/img/sprite.svg#music"></use>
                                        </svg>
                                        <div class="plus__main-line">Количество городов</div>
                                        <div class="plus__main-info"><span class="bold-small">{{ $shop->cities_cnt }}</span>
                                            {{ trans_choice('dic.cities', $shop->cities_cnt) }}
                                        </div>
                                    </div>
                                @endif
                                @if (!empty($shop->delivery_cost))
                                    <div class="plus__main-item">
                                        <svg class="icon" width="40px" height="40px">
                                            <use xlink:href="/img/sprite.svg#dollar-symbol"></use>
                                        </svg>
                                        <div class="plus__main-line">Цена доставки</div>
                                        <div class="plus__main-info"><span class="bold-small">{{ $shop->delivery_cost }}</span></div>
                                    </div>
                                @endif
                                @if (!empty($shop->delivery_time))
                                    <div class="plus__main-item">
                                        <svg class="icon" width="40px" height="40px">
                                            <use xlink:href="/img/sprite.svg#clock"></use>
                                        </svg>
                                        <div class="plus__main-line">Время доставки</div>
                                        <div class="plus__main-info"><span class="bold-small">{{ $shop->delivery_time }}</span></div>
                                    </div>
                                @endif
                                @if (!empty($shop->brands_cnt))
                                    <div class="plus__main-item">
                                        <svg class="icon" width="40px" height="40px">
                                            <use xlink:href="/img/sprite.svg#medal"></use>
                                        </svg>
                                        <div class="plus__main-line">Количество брендов</div>
                                        <div class="plus__main-info"><span class="bold-small">{{ $shop->brands_cnt }}</span></div>
                                    </div>
                                @endif
                                @if (!empty($shop->products_cnt))
                                    <div class="plus__main-item">
                                        <svg class="icon" width="40px" height="40px">
                                            <use xlink:href="/img/sprite.svg#sound-bars"></use>
                                        </svg>
                                        <div class="plus__main-line">Количество товаров</div>
                                        <div class="plus__main-info"><span class="bold-small">{{ $shop->products_cnt }}</span></div>
                                    </div>
                                @endif
                                @if (!empty($shop->discounts))
                                    <div class="plus__main-item">
                                        <svg class="icon" width="40px" height="40px">
                                            <use xlink:href="/img/sprite.svg#star-on-red"></use>
                                        </svg>
                                        <div class="plus__main-line">Скидки</div>
                                        <div class="plus__main-info"><span class="bold-small">{{ $shop->discounts }}</span></div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @include('partials.contents', ['contents' => $shop->contents])
                        <div class="page-article text">
                            {!! $shop->content !!}
                        </div>
                        <div class="banner js-banner">
                            <picture>
                                <img src="{{ asset($shop->img) }}" alt="{{ $shop->name }}">
                            </picture>
                            <div class="banner__header">
                                <div class="banner__title">{{ $shop->name }}</div>
                            </div>
                            <a href="{{ url($shop->pixel) }}" target="_blank" class="banner__link">Перейти на сайт</a>
                        </div>
                        <div class="page-reviews text">
                            <h2>Отзывы о сексшопе "{{ $shop->name }}"</h2>
                            <div class="product__choose">
                                <div class="product__choose-box">
                                    <button type="button" class="product__choose-link js-review-type _color__blue active" data-type="all">Все отзывы</button>
                                    <button type="button" class="product__choose-link js-review-type _color__black" data-type="positive">Положительные отзывы</button>
                                    <button type="button" class="product__choose-link js-review-type _color__red" data-type="negative">Отрицательные отзывы</button>
                                </div>
                            </div>
                            <div class="recall inner__recall">
                                @foreach ($shop->reviews as $review)
                                    <div class="review {{ $review->isNegative() ? '_border-color': '' }}" itemscope itemtype="http://schema.org/Review">
                                        <meta itemprop="itemReviewed" content="{{ $shop->name }}">
                                        <div class="review__header">
                                            <a href="{{ route('shops.show', $shop) }}" class="review__title">{{ $shop->name }}</a>
                                            <div class="review__autor" itemprop="author" itemscope itemtype="https://schema.org/Person">
                                                <span itemprop="name">{{ $review->author_name }}</span>, {{ $review->created_at->format('d.m.Y') }}
                                            </div>
                                            <meta itemprop="datePublished" content="{{ $review->created_at->format('d.m.Y') }}">
                                        </div>
                                        <div class="review__text" itemprop="description">— {{ $review->content }}</div>
                                        <div class="review__footer">
                                            <div class="review__progress" itemscope itemtype="http://schema.org/AggregateRating">
                                                <meta itemprop="itemReviewed" content="{{ $shop->name }}">
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
                            <div class="recall__wrap">
                                <a href="{{ $shop->slug }}/reviews#form_review" class="recall__wrap-link">Оставить отзыв</a>
                                <a href="{{ $shop->slug }}/reviews" class="recall__wrap-action">Читать все отзывы</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="/js/sidebar.js"></script>
    <script src="/js/product.js"></script>
@endpush