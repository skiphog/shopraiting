<?php

/**
 * @var Shop[] $shops
 */

use App\Models\Shop;

?>
@if($shops->isNotEmpty())
    @push('styles')
        <link rel="stylesheet" href="/css/sidebar.css">
        <link rel="stylesheet" href="/css/slick.css">
    @endpush
    @push('scripts')
        <script src="/js/slider.js"></script>
    @endpush
    <aside class="sidebar">
        <div class="sidebar__item sidebar__item-desktop sticky-sidebar__item">
            <div class="sidebar__item-title">Лучшие сексшопы</div>
            <div class="sidebar__slider">
                @foreach ($shops as $key => $shop)
                    <div class="sidebar__slider-item {{ $key > 0 ? 'hidden': '' }}">
                        <a href="{{ route('shops.show', $shop) }}" class="sidebar__slider-img">
                            <picture>
                                <img src="{{ $shop->img }}" alt="{{ $shop->name }}">
                            </picture>
                        </a>
                        <div class="sidebar__slider-line">
                            {{ ++$key }} место
                        </div>
                        <a href="{{ route('shops.show', $shop) }}" class="sidebar__slider-name">{{ $shop->name }}</a>
                        <div class="sidebar__progress" itemscope itemtype="http://schema.org/AggregateRating">
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
                        <a href="{{ url($shop->pixel) }}" class="sidebar__slider-action" target="_blank">Перейти на сайт</a>
                    </div>
                @endforeach

            </div>
            <button type="button" class="sidebar__slider-next">
                <svg class="icon" width="40px" height="40px">
                    <use xlink:href="/img/sprite.svg#ar-next"></use>
                </svg>
            </button>
            <button type="button" class="sidebar__slider-prew">
                <svg class="icon" width="40px" height="40px">
                    <use xlink:href="/img/sprite.svg#ar-prev"></use>
                </svg>
            </button>
        </div>
    </aside>
@endif
