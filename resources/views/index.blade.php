<?php

/**
 * @var \App\Models\Shop[]   $shops
 * @var \App\Models\Review[] $reviews
 * @var \App\Models\Category $category
 */

?>
@extends('layouts.app')

@section('title', $category->seo_title)
@section('description', $category->seo_description)

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
            {{-- Banner => управление баннером тоже бы в админку --}}
            <div class="banner-wrapper">
                <a href="https://go.acstat.com/2302cd986ee84c90" target="_blank" rel="noopener noreferrer">
                    <img src="/img/banner.jpg" width="875" height="240" alt="">
                </a>
            </div>
            {{-- // Banner --}}

            <h1>{{ $category->seo_h1 ?: $category->name }}</h1>

            @if(!empty($category->before_content))
                <div class="text">
                    <p>{{ $category->before_content }}</p>
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
                @if(request()->routeIs('index'))
                    @include('main.recall', ['shops' => $shops, 'current_slug' => $category->slug, 'reviews' => $reviews])
                @else
                    @include('categories.recall', ['category' => $category, 'shops' => $shops, 'current_slug' => $category->slug, 'reviews' => $reviews])
                @endif
            </div>

            @include('main.table', compact('shops'))
            @include('main.person', ['user' => $category->user])

            {!! $category->content !!}
        </div>
    </main>
@endsection

@push('scripts')
    <script src="/js/showcase.js"></script>
    <script src="/js/reviews_main.js"></script>
@endpush