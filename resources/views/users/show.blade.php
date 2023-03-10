<?php

/**
 * @var \App\Models\User     $user
 * @var \App\Models\Banner[] $banners
 */

?>
@extends('layouts.app')

@section('title', 'Автор проекта ' . $user->name . ' ' . config('app.name'))
@section('description', 'Автор проекта ' . $user->name . ' ' . config('app.name'))

@push('styles')
    <link rel="stylesheet" href="/css/writer.css">
@endpush

@section('content')
    <main class="main">
        <div class="inner">
            <div class="wrap">
                @include('partials.breadcrumbs', ['data' => [['link' => route('authors.index'), 'title' => 'Авторы'], ['link' => '', 'title' => $user->name]]])
                <h1>Автор</h1>
                <div class="content">
                    @include('partials.slider')
                    <div class="main-content">
                        <div class="writer">
                            <div class="writer__box" id="user-{{ $user->id }}" itemprop="author" itemscope itemtype="https://schema.org/Person">
                                <div class="writer__box-header">
                                    <img src="{{ asset($user->avatar) }}" width="40" height="40" alt="person" itemprop="image">
                                    <div class="writer__box-name" itemprop="name">{{ $user->name }}</div>
                                </div>
                                <div class="writer__box-text">{!! $user->description !!}</div>
                                <div class="writer__box-articles">
                                    @foreach($user->articles as $article)
                                        <a href="{{ route('articles.show', $article) }}" class="writer__box-link">{{ $article->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection