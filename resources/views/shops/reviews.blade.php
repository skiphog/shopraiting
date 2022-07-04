<?php

/**
 * @var \App\Models\Shop     $shop
 * @var \App\Models\Review[] $reviews
*/

?>
@extends('layouts.app')

@section('title', "Секс шоп «{$shop->name}» – Реальные отзывы покупателей")
@section('description', "Мы собрали для вас только настоящие отзывы от реальных покупателей о секс шопе «{$shop->name}». Поэтому прежде чем делать покупку - изучите мнения клиентов!")

@section('og_image')
    <meta property="og:image" content="{{ asset($shop->img) }}">
@endsection

@push('styles')
    <link rel="stylesheet" href="/css/offer.css">
    <link rel="stylesheet" href="/css/sidebar.css">
    <link rel="stylesheet" href="/css/product.css">
    <link rel="stylesheet" href="/css/banner.css">
    <link rel="stylesheet" href="/css/recall.css">
    <link rel="stylesheet" href="/css/case.css">
    <link rel="stylesheet" href="/css/pagination.css">
    <link rel="stylesheet" href="/css/feedback.css">
@endpush

@section('content')
    <main class="main">
        <div class="inner">
            <div class="wrap">
                @include('partials.breadcrumbs', ['data' => [
                    ['link' => route('shops.index'), 'title' => 'Магазины'],
                    ['link' => route('shops.show', $shop), 'title' => $shop->name],
                    ['link' => '', 'title' => "Отзывы о {$shop->name}"]
                ]])
                <h1>Отзывы покупателей секс-шопа «{{ $shop->name }}»</h1>
                <div class="content">
                    <div class="main-content">
                        <div class="offer">
                            <div class="offer__header">
                                <div class="offer__header-box">
                                    <div class="offer__header-title">{{ $shop->name }}</div>
                                </div>
                                <div class="offer__progress" itemscope itemtype="http://schema.org/AggregateRating">
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
                                        <div class="progress" style="width: {{ $shop->rating_reverse }}%"></div>
                                    </div>
                                    <div itemprop="ratingValue" class="rating">{{ $shop->rating_value_format }}</div>
                                    <meta itemprop="ratingCount" content="{{ $shop->reviews_count }}">
                                </div>
                            </div>
                            <div class="offer__main">
                                <div class="offer__logo-box">
                                    <picture>
                                        <img src="{{ $shop->img }}" alt="{{ $shop->name }}">
                                    </picture>
                                </div>
                                <div class="offer__main-wrapper">
                                    <div class="offer__main-text">
                                        Секс шоп «{{ $shop->name }}» работает с {{ $shop->founding_year }} года.
                                        Мы собрали отзывы реальных покупателей товаров в интернет-магазине «{{ $shop->name }}»
                                        за 2018-2019 годы. Если вы покупали товары в этом секс-шопе, то вы можете
                                        оставить свой отзыв через форму в конце страницы.
                                    </div>
                                </div>
                            </div>
                            <div class="offer__rating">
                                <div class="offer__rating-title">Оценки пользователей</div>
                                @foreach ($shop->getCounts() as $key => $value)
                                    <div class="offer__rating-box">
                                        <div class="stardom">
                                            @for($i = 1; $i<= 5; $i++)
                                                @if($i <= $key)
                                                    <div class="stardom__item full"></div>
                                                @else
                                                    <div class="stardom__item"></div>
                                                @endif
                                            @endfor
                                        </div>
                                        <div class="rating__progress">
                                            <progress class="rating__progress-item" value="{{ $value['percent'] }}" max="100"></progress>
                                            <output class="rating__progress-value" value="{{ $value['count'] }}">{{ $value['count'] }}</output>
                                            <div class="rating__progress-text">{{ trans_choice('dic.mark', $value['count']) }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="recall">@include('shops.recall', compact('reviews'))</div>
                        @include('reviews.review_form', ['shop' => $shop])
                        <div class="banner js-banner">
                            <picture>
                                <img src="{{ asset($shop->img) }}" alt="{{ $shop->name }}">
                            </picture>
                            <div class="banner__header">
                                <div class="banner__title">{{ $shop->name }}</div>
                            </div>
                            <a href="{{ url($shop->pixel) }}" target="_blank" class="banner__link">Перейти на сайт</a>
                        </div>
                    </div>
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
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="/js/sidebar.js"></script>
    <script src="/js/recalls.js"></script>
@endpush