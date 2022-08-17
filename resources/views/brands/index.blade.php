<?php

/**
 * @var \App\Models\Brand[] $brands
 */

?>
@extends('layouts.app')

@section('title', 'Бренды секс игрушек - лучшие производители')
@section('description', 'Лучшие бренды производители секс игрушек проверенные временем и отзывами тысяч покупателей по всему миру.')

@push('styles')
    <link rel="stylesheet" href="/css/popularity.css">
    <link rel="stylesheet" href="/css/brands.css">
@endpush

@section('content')
    <main class="main">
        <div class="inner">
            <div class="wrap">
                @include('partials.breadcrumbs', ['data' => [['link' => '', 'title' => 'Бренды']]])
                <h1>Бренды секс-игрушек</h1>
                <div class="text">
                    @if($brands->isNotEmpty())
                        <div class="brands">
                            <h2 class="brands__h2">Бренды</h2>
                            <div class="brands__container">
                                @foreach ($brands->chunk(floor($brands->count() / 2)) as $chunk)
                                    <div class="brands__column-wrapper">
                                        <div class="brands__column">
                                            @foreach ($chunk as $brand)
                                                <div class="brands__item">
                                                    <img class="brands__image" src="{{ asset($brand->img) }}" alt="{{ $brand->name }}" width="auto" height="120px">
                                                    <p><span>Официальный сайт:</span>
                                                        <a class="brands__link" href="{{ $brand->link }}" target="_blank" rel="noopener noreferrer">{{ $brand->link }}</a>
                                                    </p>
                                                    <p class="brands__country"><span>Страна:</span> {{ $brand->country }}</p>
                                                    <p class="brands__rating"><span>Рейтинг:</span> {{ $brand->rating_value_format }}</p>
                                                    <p class="brands__description">{{ $brand->description }}</p>
                                                    <div class="brands__buttons-wrapper">
                                                        <a class="brands__link-button btn" href="{{ route('shops.index') }}">Купить</a>
                                                        <a class="brands__link-button btn" href="{{ route('brands.reviews', $brand) }}">Отзывы</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection