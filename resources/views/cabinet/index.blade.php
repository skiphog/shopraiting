<?php

/**
 * @var \App\Models\User $user
 */

?>
@extends('layouts.cabinet')

@section('title', 'Кабинет')
@section('description', 'Кабинет')

@push('style')
    <style>
        .card-hover{transition:box-shadow .3s}
        .card-hover:hover{box-shadow:0 3px 12px 1px rgba(43,55,72,.15)!important}
    </style>
@endpush

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Личный кабинет</h3>
                <div class="nk-block-des text-soft"><p>Добро пожаловать!</p>
                </div>
            </div>
        </div>
    </div>
    @includeUnless($user->hasVerifiedEmail(), 'cabinet.partials.warning')
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-12">
                <ul class="row g-gs preview-icon-svg">
                    <li class="col-lg-4 col-sm-6 col-12">
                        <a class="preview-icon-box card card-bordered card-hover" href="{{ route('index') }}">
                            <div class="preview-icon-wrap">
                                <img src="/dashboard/icons/help-desk.svg" width="90" height="90" alt="">
                            </div>
                            <div><span class="title fw-bold fs-17px text-body">На главную</span></div>
                            <div class="fw-medium">Перейти</div>
                        </a>
                    </li>
                    <li class="col-lg-4 col-sm-6 col-12">
                        <a class="preview-icon-box card card-bordered card-hover" href="{{ route('cabinet.profile.index') }}">
                            <div class="preview-icon-wrap">
                                <img src="/dashboard/icons/settings.svg" width="90" height="90" alt="">
                            </div>
                            <div><span class="title fw-bold fs-17px text-body">Профиль</span></div>
                            <div><span class="fw-medium">{{ $user->name }}</span></div>
                        </a>
                    </li>
                    <li class="col-lg-4 col-sm-6 col-12">
                        @if($user->hasVerifiedEmail())
                            <a class="preview-icon-box card card-bordered card-hover" href="{{ route('cabinet.articles.index') }}">
                                <div class="preview-icon-wrap">
                                    <img src="/dashboard/icons/profile.svg" width="90" height="90" alt="">
                                </div>
                                <div><span class="title fw-bold fs-17px text-body">Статьи</span></div>
                                <div><span class="fw-medium">Просмотреть</span></div>
                            </a>
                        @else
                            <div class="preview-icon-box card card-bordered card-hover" href="{{ route('cabinet.articles.index') }}">
                                <div class="preview-icon-wrap">
                                    <img src="/dashboard/icons/profile-1.svg" width="90" height="90" alt="">
                                </div>
                                <div><span class="title fw-bold fs-17px text-body">Статьи</span></div>
                                <div><span class="fw-medium">Подтвердите email</span></div>
                            </div>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection