<?php

/**
 * @var \App\Models\Article[] $articles
 */

?>
@extends('layouts.app')

@section('title', 'Статьи о сексшопах и секс игрушках')
@section('description', 'Статьи о сексшопах и секс игрушках')

@push('styles')
    <link rel="stylesheet" href="/css/list.css">
    <link rel="stylesheet" href="/css/pagination.css">
@endpush

@section('content')
    <main class="main">
        <div class="inner">
            <div class="wrap">
                @include('partials.breadcrumbs', ['data' => [['link' => '', 'title' => 'Статьи']]])
                <h1>Статьи о сексшопах</h1>
                <div class="content">
                    <div class="main-content">
                        <div class="list">
                            @foreach($articles as $article)
                                <div class="list__box" itemscope itemtype="https://schema.org/BlogPosting">
                                    <a href="{{ route('articles.show', $article) }}" class="list__box-link" itemprop="url">
                                        <picture>
                                            <img class="list__box-image" src="{{ asset($article->img) }}" alt="{{ $article->name }}" itemprop="image">
                                        </picture>
                                    </a>
                                    <div class="list__box-main">
                                        <div class="list__box-info">
                                            <a href="{{ route('authors') . "#user-{$article->user->id}" }}" class="list__box-item list__box-person"><span itemprop="author">{{ $article->user->name }}</span></a>
                                            <div class="list__box-item" itemprop="dateCreated">{{ $article->created_at->format('d.m.Y') }}</div>
                                            <div class="list__box-item">{{ $article->view }} {{ trans_choice('dic.view', $article->view) }}</div>
                                            <div class="list__box-item">{{ $article->time_to_read }} {{ trans_choice('dic.minutes', $article->time_to_read) }}</div>
                                        </div>
                                        <a href="{{ route('articles.show', $article) }}" class="list__box-title"><span itemprop="headline">{{ $article->name }}</span></a>
                                        <div class="list__box-discription" itemprop="articleBody">
                                            {{ $article->intro }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{ $articles->onEachSide(1)->links('partials.paginate') }}
                    </div>
                    @include('partials.slider')
                </div>
            </div>
        </div>
    </main>
@endsection