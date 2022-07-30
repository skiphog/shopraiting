<?php

/**
 * @var \App\Models\Comment[] $mod_comments
 * @var \App\Models\Comment[] $comments
 */

?>
@extends('layouts.admin')

@section('title', 'Комментарии')
@section('description', 'Комментарии')

@section('content')
    @if($mod_comments->isNotEmpty())
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Комментарии на модерации</h3>
                    <div class="nk-block-des text-soft">
                        <p>Всего {{ $mod_comments->count() }} {{ trans_choice('dic.comments', $mod_comments->count()) }}</p>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.comments.table', ['comments' => $mod_comments])
    @endif

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Все комментарии</h3>
                <div class="nk-block-des text-soft">
                    <p>Всего {{ $comments->total() }} {{ trans_choice('dic.comments', $comments->total()) }}</p>
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
                                            data-search-url="{{ route('admin.search.comments') }}"
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
        @include('admin.comments.table', compact('comments'))
        <div class="card-inner">
            <div class="nk-block-between-md g-3">
                <div class="g">
                    {{ $comments->onEachSide(2)->links('admin.partials.paginate') }}
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="/dashboard/js/search.js"></script>
@endpush