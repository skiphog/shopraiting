<?php

/**
 * @var \App\Models\Review[] $reviews
 * @var string               $current_slug
 */

?>
<div class="recall inner__recall">
    <div class="recall__box  _mini-style">
        <div class="recall__header  _mini-style">
            <!--suppress HtmlFormInputWithoutLabel -->
            <select class="recall__header-select js-product-select">
                <option value="{{ route('reviews.index') }}">Все сексшопы</option>
                @foreach ($shops = \App\Models\Shop::getAllWithCache() as $shop)
                    <option value="{{ route('reviews.shop', $shop) }}" {{ $current_slug === $shop->slug ? 'selected': '' }}>
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
                        class="recall__main-link js-type-review _color__blue {{ !request('rating') ? 'active' : '' }}"
                        data-link="{{ request()->url() }}">
                    Все отзывы
                </button>
                <button type="button"
                        class="recall__main-link js-type-review _color__black {{ request('rating') === 'positive' ? 'active' : '' }}"
                        data-link="{{ request()->url() . '?rating=positive' }}">
                    Положительные отзывы
                </button>
                <button type="button"
                        class="recall__main-link js-type-review _color__red {{ request('rating') === 'negative' ? 'active' : '' }}"
                        data-link="{{ request()->url() . '?rating=negative' }}">
                    Отрицательные отзывы
                </button>
            </div>
        </div>
    </div>
    @include('reviews.partials.reviews', compact('reviews'))
</div>

{{ $reviews->onEachSide(1)->links('partials.paginate') }}