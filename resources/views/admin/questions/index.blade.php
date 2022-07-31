<?php

/**
 * @var \App\Models\Question[] $mod_questions
 * @var \App\Models\Question[] $questions
 */

?>
@extends('layouts.admin')

@section('title', 'Вопросы')
@section('description', 'Вопросы')

@section('content')
    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Панель</a></li>
            <li class="breadcrumb-item active">Вопросы</li>
        </ul>
    </nav>

    @if($mod_questions->isNotEmpty())
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Вопросы на модерации</h3>
                    <div class="nk-block-des text-soft">
                        <p>Всего {{ $mod_questions->count() }} {{ trans_choice('dic.questions', $mod_questions->count()) }}</p>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.questions.table', ['questions' => $mod_questions])
    @endif

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Все вопросы</h3>
                <div class="nk-block-des text-soft">
                    <p>Всего {{ $questions->total() }} {{ trans_choice('dic.questions', $questions->total()) }}</p>
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
                                            data-search-url="{{ route('admin.search.questions') }}"
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
        @include('admin.questions.table', compact('questions'))
        <div class="card-inner">
            <div class="nk-block-between-md g-3">
                <div class="g">
                    {{ $questions->onEachSide(2)->links('admin.partials.paginate') }}
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="/dashboard/js/search.js"></script>
@endpush