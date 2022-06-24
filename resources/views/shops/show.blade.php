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
    <link rel="stylesheet" href="/css/keep.css">
    <link rel="stylesheet" href="/css/banner.css">
    <link rel="stylesheet" href="/css/text.css">
@endpush

@section('content')
    <main class="main">
        <div class="inner-back">
            <div class="wrap">
                <div class="breads">
                    <div class="breads__box"><a href="/" class="breads__link">Главная</a></div>
                    <div class="breads__box"><a href="{{ route('shops.index') }}" class="breads__link">Магазины</a></div>
                    <div class="breads__box"><a class="breads__link">{{ $shop->name }}</a></div>
                </div>
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
                                    <meta itemprop="ratingCount" content="333">
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
                                    <a href="#/reviews" class="plus__header-link">333 {{ trans_choice('dic.review', 333) }}</a>
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
                        @if (!empty($shop->contents))
                            <div id="keep-one" class="keep">
                                <a href="#" class="keep__link">Содержание
                                    <svg class="icon icon-keep" width="8" height="8">
                                        <use xlink:href="/img/sprite.svg#down-arrow"></use>
                                    </svg>
                                </a>
                                <ul id="menu">
                                    @foreach($shop->contents as $item)
                                        <li><a href="#{{ key($item) }}">{{ array_shift($item) }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
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