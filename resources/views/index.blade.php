<?php

/**
 * @var \App\Models\Shop[] $shops
 */

?>
@extends('layouts.app')

@section('title', 'Лучшие секс-шопы Москвы – онлайн магазины для взрослых')
@section('description', 'Не знаете какой секс шоп выбрать и где купить секс игрушки? Мы создали список лучших интернет-магазинов для вас!')

@push('styles')
    <link rel="stylesheet" href="/css/showcase.css">
@endpush

@section('content')
    <main class="main">
        <div class="wrap">
            <div class="banner-wrapper">
                <a href="https://go.acstat.com/2302cd986ee84c90" target="_blank" rel="noopener noreferrer">
                    <img src="/img/banner.jpg" width="875" height="240" alt="">
                </a>
            </div>
            <h1>Рейтинг лучших сексшопов 2021</h1>
            <div class="text">
                <p>
                    Секс игрушки – это один из наиболее удачных способов не только разнообразить свою сексуальную жизнь,
                    но и, порой, даже спасти угасающие отношения. А обеспечивают такими палочками-выручалочками
                    специализированные магазины интим товаров. Но как понять, что это стоящий сервис, а не очередная
                    низкосортная «забегаловка»? Разобраться в этом вам поможет наш проект SexShopRating.
                </p>
            </div>
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
                                <a href="{{ url($shop->pixel) }}" target="_blank" data-goal="click-{{ $shop->slug }}" class="cart__footer-link">Перейти на сайт</a>
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

            <div>
                CompReviewLast | CompCompareTable | CompProductCategoryContent
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="/js/showcase.js"></script>
@endpush