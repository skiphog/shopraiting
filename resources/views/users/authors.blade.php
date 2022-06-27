<?php

/**
 * @var \App\Models\User[] $users
 */

?>
@extends('layouts.app')

@section('title', 'Авторы проекта ' . config('app.name'))
@section('description', 'Авторы проекта ' . config('app.name'))

@push('styles')
    <link rel="stylesheet" href="/css/writer.css">
@endpush

@section('content')
    <main class="main">
        <div class="inner">
            <div class="wrap">
                @include('partials.breadcrumbs', ['data' => [['link' => '', 'title' => 'Авторы']]])
                <h1>Авторы проекта</h1>
                <div class="content">
                    @include('partials.slider')
                    <div class="main-content">
                        <div class="writer">
                            @foreach($users as $user)
                                <div class="writer__box" id="user-{{ $user->id }}">
                                    <div class="writer__box-header">
                                        <img src="{{ asset($user->avatar) }}" width="40" height="40" alt="person">
                                        <div class="writer__box-name">{{ $user->name }}</div>
                                    </div>
                                    <div class="writer__box-text">{{ $user->description }}</div>
                                    <div class="writer__box-articles">
                                        @foreach($user->articles as $article)
                                            <a href="{{ route('articles.show', $article) }}" class="writer__box-link">{{ $article->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection