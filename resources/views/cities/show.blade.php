<?php

/**
 * @var \App\Models\Shop[]   $shops
 * @var \App\Models\Review[] $reviews
 * @var \App\Models\City     $city
 * @var \App\Models\Banner[] $banners
 */

?>
@extends('layouts.app')

@section('title', $city->seo_title)
@section('description', $city->seo_description)

@push('styles')
    <link rel="stylesheet" href="/css/select2.css">
    <link rel="stylesheet" href="/css/showcase.css">
    <link rel="stylesheet" href="/css/text.css">
    <link rel="stylesheet" href="/css/recall.css">
    <link rel="stylesheet" href="/css/case.css">
    <link rel="stylesheet" href="/css/advantures.css">
@endpush

@section('content')
    <main class="main">
        <div class="wrap">
            @include('partials.banners', compact('banners'))
            @include('partials.breadcrumbs', ['data' => [['link' => route('cities.index'), 'title' => 'Города'], ['link' => '', 'title' => "Сексшопы в городе {$city->name}"]]])
            <h1>{{ $city->seo_h1 ?: $city->name }}</h1>

            @if(!empty($city->before_content))
                <div class="text">
                    <p>{{ $city->before_content }}</p>
                </div>
            @endif

            <div id="showcase" class="showcase">
                <div class="showcase__carts">
                    @foreach($shops as $key => $shop)
                        <div class="cart {{ ++$key > \App\Models\Shop::MAX_MAIN_SHOW ? 'hide' : '' }}">
                            <div class="cart__header">
                                <a href="{{ route('shops.show', $shop) }}" class="cart__header-img">
                                    <picture>
                                        <img src="{{ asset($shop->img) }}" alt="{{ $shop->name }}">
                                    </picture>
                                </a>
                                <div class="cart__header-progress" itemscope itemtype="https://schema.org/AggregateRating">
                                    <meta itemprop="itemReviewed" content="{{ $shop->name }}">
                                    <div class="stars">
                                        <svg class="icon" width="16px" height="16px">
                                            <use xlink:href="/img/sprite.svg#heart"></use>
                                        </svg>
                                        <svg class="icon" width="16px" height="16px">
                                            <use xlink:href="/img/sprite.svg#heart"></use>
                                        </svg>
                                        <svg class="icon" width="16px" height="16px">
                                            <use xlink:href="/img/sprite.svg#heart"></use>
                                        </svg>
                                        <svg class="icon" width="16px" height="16px">
                                            <use xlink:href="/img/sprite.svg#heart"></use>
                                        </svg>
                                        <svg class="icon" width="16px" height="16px">
                                            <use xlink:href="/img/sprite.svg#heart"></use>
                                        </svg>
                                        <div class="progress" style="width: {{ $shop->rating_reverse }}%"></div>
                                    </div>
                                    <div itemprop="ratingValue" class="rating">{{ $shop->rating_value_format }}</div>
                                    <meta itemprop="ratingCount" content="{{ $shop->reviews_count }}">
                                </div>
                            </div>

                            <div class="cart__main">
                                <div class="cart__main-wrap">
                                    <a href="{{ route('shops.show', $shop) }}" class="cart__main-title">{{ $shop->name }}</a>
                                    <div class="cart__main-capture">
                                        {{ $shop->advantage }}
                                    </div>
                                </div>
                                <div class="cart__box">
                                    {{ $shop->description }}
                                </div>
                            </div>
                            <div class="cart__footer">
                                <div class="cart__footer-line">{{ $shop->advantage }}</div>
                                <a href="{{ url($shop->pixel) }}" target="_blank" data-goal="click-{{ $shop->slug }}"
                                        class="cart__footer-link">Перейти на сайт</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($shops->count() > \App\Models\Shop::MAX_MAIN_SHOW)
                    <div class="showcase__more">
                        <button type="button" class="showcase__more-link">Показать другие магазины</button>
                    </div>
                @endif
            </div>

            <div class="text">
                <h2>Отзывы о сексшопах</h2>
                <p>Мы собрали для вас отзывы реальных покупателей товаров в секс шопах. Пожалуйста, ознакомьтесь с
                    отзывами от мужчин и женщин, прежде чем сделать выбор.
                </p>
            </div>

            <div class="recall" id="recall">
                @include('cities.recall', ['city' => $city, 'shops' => $shops, 'current_slug' => $city->slug, 'reviews' => $reviews])
            </div>

            @include('main.table', compact('shops'))

            {!! $city->content !!}
        </div>
    </main>
@endsection

@push('scripts')
    <script src="/js/showcase.js"></script>
    <script src="/js/reviews_main.js"></script>
@endpush