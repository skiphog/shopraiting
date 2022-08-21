<?php

/**
 * @var \App\Models\Brand $brand
 */

?>
@extends('layouts.app')

@section('title', $brand->seo_title)
@section('description', $brand->seo_description)

@section('og_image')
    <meta property="og:image" content="{{ asset($brand->img) }}">
@endsection

@push('styles')
    <link rel="stylesheet" href="/css/offer.css">
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
                    ['link' => route('brands.index'), 'title' => 'Бренды'],
                    ['link' => '', 'title' => "Отзывы о {$brand->name}"]
                ]])
                <h1>{{ $brand->seo_h1 }}</h1>
                <div class="content">
                    <div class="main-content">
                        <div class="offer">
                            <div class="offer__header">
                                <div class="offer__header-box">
                                    <div class="offer__header-title">{{ $brand->name }}</div>
                                </div>
                                <div class="offer__progress" itemscope itemtype="http://schema.org/AggregateRating">
                                    <meta itemprop="itemReviewed" content="{{ $brand->name }}">
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
                                        <div class="progress" style="width: {{ $brand->rating_reverse }}%"></div>
                                    </div>
                                    <div itemprop="ratingValue" class="rating">{{ $brand->rating_value_format }}</div>
                                    <meta itemprop="ratingCount" content="999">
                                </div>
                            </div>
                            <div>
                                <picture>
                                    <img src="{{ $brand->img }}" alt="{{ $brand->name }}">
                                </picture>
                            </div>
                            <div class="offer__main">
                                <div class="offer__main-wrapper">
                                    <div class="offer__main-text">
                                        {!! $brand->content !!}
                                    </div>
                                </div>
                            </div>

                            <div class="offer__rating">
                                <div class="offer__rating-title">Оценки пользователей</div>
                                @foreach ($brand->getCounts() as $key => $value)
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
                                            <!--suppress HtmlUnknownAttribute -->
                                            <output class="rating__progress-value" value="{{ $value['count'] }}">{{ $value['count'] }}</output>
                                            <div class="rating__progress-text">{{ trans_choice('dic.mark', $value['count']) }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div id="recall">@include('shops.recall', compact('reviews'))</div>
                        @include('reviews.review_brand_form', compact('brand'))
                        <div class="banner js-banner">
                            <picture>
                                <img src="{{ asset($brand->img) }}" alt="{{ $brand->name }}">
                            </picture>
                            <div class="banner__header">
                                <div class="banner__title">{{ $brand->name }}</div>
                            </div>
                            <a href="{{ route('shops.index') }}" target="_blank" class="banner__link">Где купить {{ $brand->name }}</a>
                        </div>
                    </div>
                    @include('partials.slider')
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
<!--suppress ES6ConvertVarToLetConst -->
<script>
  (function ($) {
    var recall = $('#recall');

    recall.on('click', '.js-review-type:not(.active)', function () {
      var _l = $(this).data('link');
      $.get(_l, function (data) {
        recall.html(data);
        window.history.pushState({}, '', _l);
      });
    });

    $('#recall').on('click', '.js-review-like', function () {
      var _this = $(this);
      var review_id = +_this.data('review');
      var likes = JSON.parse(window.localStorage.getItem('reviews_likes') || '[]');

      if (!likes.length || !~likes.indexOf(review_id)) {
        likes.push(review_id);
        window.localStorage.setItem('reviews_likes', JSON.stringify(likes));
        _this.attr('data-count', +_this.data('count') + 1);
        $.post('/reviews/' + review_id + '/like');
      }
    });
  })(jQuery);
</script>
@endpush