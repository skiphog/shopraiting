<?php

/**
 * @var \App\Models\Category $category
 * @var \App\Models\Shop[]   $shops
 * @var \App\Models\Review[] $reviews
 * @var string               $current_slug
 */

if (request()->routeIs('categories.recalls.shop-recalls')) {
    $rout_recall = route('categories.recalls.shop-recalls', ['category' => $category, 'shop' => $current_slug]);
    $rout_all = route('shops.reviews', ['shop' => $current_slug]);
} else {
    $rout_recall = route('categories.recalls.recalls', $category);
    $rout_all = route('reviews.index');
}
?>
<div class="recall__box">
    <div class="recall__header">
        <!--suppress HtmlFormInputWithoutLabel -->
        <select class="recall__header-select">
            <option value="{{ route('categories.recalls.recalls', $category) }}">Все сексшопы</option>
            @foreach ($shops as $shop)
                <option value="{{ route('categories.recalls.shop-recalls', ['category' => $category, 'shop' => $shop]) }}" {{ $current_slug === $shop->slug ? 'selected': '' }}>
                    {{ $shop->name }}
                </option>
            @endforeach
        </select>
        <div class="recall__header-box">
            @foreach ($shops->slice(0, \App\Models\Shop::MAX_SLIDER_SHOW) as $shop)
                <a href="{{ route('shops.reviews', $shop) }}" class="recall__header-link">{{ $shop->name }}</a>
            @endforeach
        </div>
    </div>
    <div class="recall__main">
        <button type="button" class="recall__main-link _color__blue {{ !request('rating') ? 'active' : '' }}"
                data-link="{{ $rout_recall }}">Все отзывы </button>
        <button type="button" class="recall__main-link _color__black {{ request('rating') === 'positive' ? 'active' : '' }}"
                data-link="{{ $rout_recall . '?rating=positive' }}">Положительные отзывы</button>
        <button type="button" class="recall__main-link _color__red {{ request('rating') === 'negative' ? 'active' : '' }}"
                data-link="{{ $rout_recall . '?rating=negative' }}">Отрицательные отзывы</button>
    </div>
</div>

@include('reviews.partials.reviews', compact('reviews'))

<div class="recall__wrap">
    <a href="{{ $rout_all }}#form_review" class="recall__wrap-link">Оставить отзыв</a>
    <a href="{{ $rout_all }}" class="recall__wrap-action">Читать все отзывы</a>
</div>
