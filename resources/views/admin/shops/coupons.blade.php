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

    <form action="{{ route('admin.shops.coupons.update', $shop) }}" class="crutch-validate is-alter">

        <div class="nk-block" id="coupons">
            @foreach($shop->coupons as $index => $coupon)
                <div class="card card-bordered">
                    <div class="card-inner">
                        <div class="row g-gs">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="title[{{ $index }}]">Title</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control"
                                                id="title[{{ $index }}]"
                                                name="title[{{ $index }}]"
                                                value="{{ $coupon->title }}"
                                                placeholder="10%" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row g-gs">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="color[{{ $index }}]">Color</label>
                                            <div class="form-control-wrap">
                                                <select id="color[{{ $index }}]" class="form-control form-select select2-hidden-accessible"
                                                        name="color[{{ $index }}]" data-placeholder="Выбрать" data-msg="Выберите цвет"
                                                        required>
                                                    @foreach(\App\Models\Coupon::colorsList() as $key => $value)
                                                        <option value="{{ $key }}" @selected($key === $coupon->color)>
                                                            {{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="type[{{ $index }}]">Type</label>
                                            <div class="form-control-wrap">
                                                <select id="type[{{ $index }}]" class="form-control form-select select2-hidden-accessible"
                                                        name="type[{{ $index }}]" data-placeholder="Выбрать" data-msg="Выберите тип"
                                                        required>
                                                    @foreach(\App\Models\Coupon::typesList() as $key => $value)
                                                        <option value="{{ $key }}" @selected($key === $coupon->type)>
                                                            {{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="type_content[{{ $index }}]">Type content</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                        id="type_content[{{ $index }}]"
                                                        name="type_content[{{ $index }}]"
                                                        value="{{ $coupon->type_content }}"
                                                        placeholder="10%" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="nk-block">
            <div class="row g-gs">
                <div class="col-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
