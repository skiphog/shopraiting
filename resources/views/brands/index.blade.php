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
@endpush

@section('content')
    <main class="main">
        <div class="inner">
            <div class="wrap">
                @include('partials.breadcrumbs', ['data' => [['link' => '', 'title' => 'Бренды']]])
                <h1>Бренды секс-игрушек</h1>
                <div class="text">
                    @if($brands->isNotEmpty())
                        <div class="popularity">
                            <div class="popularity__box">
                                @foreach ($brands->chunk(floor($brands->count() / 2)) as $chunk)
                                    <div class="popularity__box-wrap">
                                        <div class="popularity__item">
                                            @foreach ($chunk as $brand)
                                                <div>
                                                    <div><img src="{{ asset($brand->img) }}" alt="{{ $brand->name }}"></div>
                                                    <div>Ссылка: {{ $brand->link }}</div>
                                                    <div>Страна: {{ $brand->country }}</div>
                                                    <div>Рейтинг: {{ $brand->rating_value_format }}</div>
                                                    <div>{{ $brand->description }}</div>
                                                    <div><a href="{{ route('brands.reviews', $brand) }}" class="popularity__item-link">{{ $brand->name }}</a></div>
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