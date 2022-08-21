<?php

/**
 * @var \App\Models\Question[] $questions
 */

?>
@extends('layouts.app')

@section('title', 'Вопросы и честные ответы о секс шопах')
@section('description', 'Список вопросов покупателей в секс шопах. Вы спрашиваете - мы отвечаем.')

@push('styles')
    <link rel="stylesheet" href="/css/pagination.css">
    <link rel="stylesheet" href="/css/question.css">
@endpush

@section('content')
    <main class="main">
        <div class="inner">
            <div class="wrap">
                @include('partials.breadcrumbs', ['data' => [['link' => '', 'title' => 'Список вопросов']]])
                <div itemscope itemtype="https://schema.org/FAQPage">
                <h1>Вопросы пользователей о секс шопах</h1>

                    <div class="content">
                        <div class="main-content">
                            <div class="question" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                                @foreach ($questions as $question)
                                    <div class="question__box">
                                        <a href="{{ route('questions.show', $question) }}" class="question__box-title">
                                            <span itemprop="name">{{ $question->message }}</span>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            {{ $questions->onEachSide(1)->links('partials.paginate') }}
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