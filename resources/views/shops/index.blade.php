<?php

/**
 * @var \App\Models\City[] $cities
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
                <h1>Список интернет-магазинов</h1>
                <div id="content">@include('shops.shops', compact('cities', 'shops'))</div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="/js/shops.js"></script>
@endpush