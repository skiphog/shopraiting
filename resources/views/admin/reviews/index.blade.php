<?php

/**
 * @var \App\Models\Review[] $mod_reviews
 * @var \App\Models\Review[] $reviews
 */

?>
@extends('layouts.admin')

@section('title', 'Отзывы')
@section('description', 'Отзывы')

@section('content')
    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Панель</a></li>
            <li class="breadcrumb-item active">Отзывы</li>
        </ul>
    </nav>

    @if($mod_reviews->isNotEmpty())
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Отзывы на модерации</h3>
                    <div class="nk-block-des text-soft">
                        <p>Всего {{ $mod_reviews->count() }} {{ trans_choice('dic.review', $mod_reviews->count()) }}</p>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.reviews.table', ['reviews' => $mod_reviews])
    @endif

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Все отзывы</h3>
                <div class="nk-block-des text-soft">
                    <p>Всего {{ $reviews->total() }} {{ trans_choice('dic.review', $reviews->total()) }}</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right"><em class="icon ni ni-search"></em></div>
                                    <!--suppress HtmlFormInputWithoutLabel -->
                                    <input
                                            class="form-control panel-search"
                                            data-search-target="#search-reviews"
                                            data-search-url="{{ route('admin.search.review') }}"
                                            type="text"
                                            placeholder="Поиск"
                                    >
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="search-reviews">
        @include('admin.reviews.table', ['reviews' => $reviews])
        <div class="card-inner">
            <div class="nk-block-between-md g-3">
                <div class="g">
                    {{ $reviews->onEachSide(2)->links('admin.partials.paginate') }}
                </div>
            </div>
        </div>

    </div>

@endsection

@push('script')
    <script src="/dashboard/js/search.js"></script>
@endpush