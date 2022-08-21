<?php

/**
 * @var \App\Models\Question $question
 */

?>
@extends('layouts.app')

@section('title', $question->seo_title)
@section('description', $question->seo_description)

@push('styles')
    <link rel="stylesheet" href="/css/pagination.css">
    <link rel="stylesheet" href="/css/reply.css">
@endpush

@section('content')
    <main class="main">
        <div class="inner">
            <div class="wrap">
                @include('partials.breadcrumbs', ['data' => [['link' => route('questions.index'), 'title' => 'Список вопросов'], ['link' => '', 'title' => $question->name]]])
                <div itemscope itemtype="https://schema.org/FAQPage">
                <h1>{{ $question->seo_h1 }}</h1>

                    <div class="content">
                        <div class="main-content">
                            <div class="reply" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                                <div class="question__box">
                                    <div class="question__box-title">{{ $question->name }}</div>
                                    <div class="question__box-line" itemprop="name">{{ $question->message }}</div>
                                </div>
                                <div class="reply__box" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                                    <div class="reply__box-header">
                                        <img class="reply__box-avatar" src="/img/circle.svg" alt="Ответ от администрации">
                                        <!--width 40px height 40px-->
                                        <div class="reply__box-title">Ответ от администрации {{ config('app.name')  }}</div>
                                    </div>
                                    <div class="reply__box-text" itemprop="text">{{ $question->answer }}</div>
                                </div>
                            </div>
                            <div class="block">
                                <a href="{{ route('questions.create') }}" class="block__action">Задать вопрос</a>
                            </div>
                        </div>
                        @include('partials.slider')
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')

@endpush