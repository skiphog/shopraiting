<?php

/**
 * @var \App\Models\Shop $shop
 */

?>
@extends('layouts.admin')

@section('title', "Купоны и акции: {$shop->name}")
@section('description', "Купоны и акции: {$shop->name}")

@section('content')
    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Панель</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.shops.index') }}">Магазины</a></li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.shops.edit', $shop) }}">{{ $shop->name }}</a>
            </li>
            <li class="breadcrumb-item active">Купоны и акции</li>
        </ul>
    </nav>
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">
                    Купоны и акции: {{ $shop->name }}
                </h3>
            </div>
        </div>
    </div>

    <div id="data_options"
            data-colors="{{ collect(\App\Models\Coupon::colorsList())->toJson(JSON_UNESCAPED_UNICODE) }}"
            data-types="{{ collect(\App\Models\Coupon::typesList())->toJson(JSON_UNESCAPED_UNICODE) }}"
            data-buttons="{{ collect(\App\Models\Coupon::buttonTypesList())->toJson(JSON_UNESCAPED_UNICODE) }}"
            data-coupons="{{ $shop->coupons }}"
            data-action="{{ route('admin.shops.coupons.update', $shop) }}"
    ></div>

    <div id="coupons"></div>
@endsection

@push('script')
    <script src="/dashboard/assets/coupons/app.js"></script>
@endpush
