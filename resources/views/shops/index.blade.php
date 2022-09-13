<?php

/**
 * @var \App\Models\Shop[] $shops
 */

?>
@extends('layouts.app')

@section('title', 'Список всех интернет-магазинов')
@section('description', 'Список всех интернет-магазинов')

@push('styles')
    <link rel="stylesheet" href="/css/popularity.css">
@endpush

@section('content')
    <main class="main">
        <div class="inner">
            <div class="wrap">
                @include('partials.breadcrumbs', ['data' => [['link' => '', 'title' => 'Магазины']]])
                <h1>Список всех интернет-магазинов</h1>
                <div class="text">
                    @if($shops->isNotEmpty())
                        <div class="popularity">
                            <h2>Сексшопы</h2>
                            <div class="popularity__box">
                                @foreach ($shops->chunk(ceil($shops->count() / 3)) as $chunk)
                                    <div class="popularity__box-wrap">
                                        <div class="popularity__item">
                                            @foreach ($chunk as $shop)
                                                <a href="{{ route('shops.show', $shop) }}" class="popularity__item-link">{{ $shop->name }}</a>
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