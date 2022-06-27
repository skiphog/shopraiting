<?php

/**
 * @var \App\Models\Article $article
 */

?>
@extends('layouts.app')

@section('title', $article->seo_title)
@section('description', $article->seo_description)

@section('og_image')
    <meta property="og:image" content="{{ asset($article->img) }}">
@endsection

@push('styles')
    <link rel="stylesheet" href="/css/article.css">
    <link rel="stylesheet" href="/css/text.css">
    <link rel="stylesheet" href="/css/author.css">
@endpush

@section('content')
    <main class="main">
        <div class="inner">
            <div class="wrap">
                @include('partials.breadcrumbs', ['data' => [['link' => route('articles.index'), 'title' => 'Статьи'],['link' => '', 'title' => $article->name]]])
                <h1>{{ $article->seo_h1 }}</h1>
                <div class="article__header">
                    <img class="article__header-person" src="{{ asset($article->user->avatar) }}" width="40" height="40" alt="{{ $article->user->name }}">
                    <div class="article__header-item">{{ $article->user->name }}</div>
                    <div class="article__header-item">{{ $article->created_at->format('d.m.Y') }}</div>
                    <div class="article__header-item">{{ $article->view }} {{ trans_choice('dic.view', $article->view) }}</div>
                    <div class="article__header-item">{{ $article->time_to_read }} {{ trans_choice('dic.minutes', $article->time_to_read) }}</div>
                </div>

                <div class="content">
                    @include('partials.slider')
                    <div class="main-content">
                        <div class="article">
                            <picture>
                                <img class="article__header-image" src="{{ asset($article->img) }}" alt="art">
                            </picture>
                            <div class="article__discription">{!! $article->before_content !!}</div>
                            @include('partials.contents', ['contents' => $article->contents])

                            <div class="page-article text">
                                {!! $article->content !!}
                            </div>
                        </div>
                        <div class="author">
                            <div class="author__header">
                                <picture>
                                    <img src="{{ asset($article->user->avatar) }}" width="40" height="40" alt="{{ $article->user->name }}">
                                </picture>
                                <div class="author__header-box">
                                    <div class="author__header-line">Об авторе статьи</div>
                                    <div class="author__header-name">{{ $article->user->name }}</div>
                                </div>
                            </div>
                            <div class="author__main">
                                {{ $article->user->description }}
                            </div>
                            <a href="#" class="author__link">Читать все статьи</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="/js/article.js"></script>
@endpush

