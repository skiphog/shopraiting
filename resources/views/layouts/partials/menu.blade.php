<?php

/**
 * @var Shop[] $shops
 */

use App\Models\Shop;

?>
<nav class="nav">
    @if($shops->isNotEmpty())
        <div class="nav__wrapper">
            <button type="button" class="nav__item nav__item-rating">
                Сексшопы
                <svg class="icon" width="8px" height="8px">
                    <use xlink:href="/img/sprite.svg#arrdwn"></use>
                </svg>
            </button>
            <div class="nav__sub">
                @foreach($shops as $shop)
                    <a href="{{ route('shops.show', $shop) }}" class="nav__sub-link">{{ $shop->name }}</a>
                @endforeach
                    <a href="{{ route('shops.index') }}" class="nav__sub-link">Все магазины</a>
            </div>
        </div>
    @endif

    <div class="nav__box">
        <a class="nav__link" href="{{ route('brands.index') }}">Бренды</a>
        <a class="nav__link" href="{{ route('reviews.index') }}">Отзывы</a>
        <a class="nav__link" href="{{ route('articles.index') }}">Статьи</a>
    </div>

    <a href="/#showcase" class="nav__link-btn">Лучшие сексшопы</a>
    <a href="mailto:{{ config('mail.from.address') }}" class="nav__link-btn nav__link-btn--mail" target="_blank" rel="noopener noreferrer">{{ config('mail.from.address') }}</a>

        @if(auth()->user())
            <a href="{{ route('cabinet.index') }}" class="nav__link-btn nav__link-btn--login">Кабинет</a>
        @else
            <a href="{{ route('login') }}" class="nav__link-btn nav__link-btn--login">Вход</a>
        @endif
</nav>