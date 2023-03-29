<?php

/**
 * @var \App\Models\Article[] $articles
 */

?>
@extends('layouts.cabinet')

@section('title', 'Мои статьи')
@section('description', 'Мои статьи')

@section('content')
    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('cabinet.index') }}">Кабинет</a></li>
            <li class="breadcrumb-item active">Статьи</li>
        </ul>
    </nav>

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Мои статьи</h3>
                <div class="nk-block-des text-soft">
                    <p>Всего {{ $articles->total() }} {{ trans_choice('dic.articles', $articles->total()) }}</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            @if($articles->isNotEmpty())
                                <li>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right"><em class="icon ni ni-search"></em>
                                        </div>
                                        <!--suppress HtmlFormInputWithoutLabel -->
                                        <input
                                                class="form-control panel-search"
                                                data-search-target="#search-reviews"
                                                data-search-url="{{ route('cabinet.search.articles') }}"
                                                type="text"
                                                placeholder="Поиск"
                                        >
                                    </div>
                                </li>
                            @endif
                            <li class="nk-block-tools-opt">
                                <a href="{{ route('cabinet.articles.create') }}" class="btn btn-primary">
                                    <em class="icon ni ni-plus"></em><span>Добавить статью</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="search-reviews">
        @if($articles->isNotEmpty())
            @include('cabinet.articles.table', ['articles' => $articles])
            <div class="card-inner">
                <div class="nk-block-between-md g-3">
                    <div class="g">
                        {{ $articles->onEachSide(2)->links('cabinet.partials.paginate') }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('script')
    <script src="/dashboard/js/search.js"></script>
@endpush