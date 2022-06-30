<?php

/**
 * @var \App\Models\Review[] $reviews
 * @var string               $current_slug
 */

?>
@extends('layouts.app')

@section('title', 'Реальные отзывы о секс шопах от покупателей')
@section('description', 'Честные отзывы от покупателей в интернет-магазинах секс шопах России')

@push('styles')
    <link rel="stylesheet" href="/css/select2.css">
    <link rel="stylesheet" href="/css/recall.css">
    <link rel="stylesheet" href="/css/case.css">
    <link rel="stylesheet" href="/css/pagination.css">
    <link rel="stylesheet" href="/css/feedback.css">
@endpush

@section('content')
    <main class="main">
        <div class="inner">
            <div class="wrap">
                @include('partials.breadcrumbs', ['data' => [['link' => '', 'title' => 'Отзывы']]])
                <h1>Отзывы о секс шопах от покупателей</h1>
                <div class="text">
                    <p>Здесь собраны отзывы пользователей о секс-шопах за 2018-2021 год. Отзывы оставлены как мужчинами,
                        так и женщинами. Вы можете оставить свой отзыв о любом секс-шопе через форму внизу страницы.</p>
                </div>
                <div class="content">
                    @include('partials.slider')
                    <div class="main-content">
                        <div id="content">@include('reviews.recall', compact('reviews', 'current_slug'))</div>
                        @include('partials.review_form', ['shop' => new \App\Models\Shop()])
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="/js/reviews.js"></script>
@endpush