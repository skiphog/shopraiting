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
    <link rel="stylesheet" href="/css/repost.css">
    <link rel="stylesheet" href="/css/comment.css">
    <link rel="stylesheet" href="/css/feedback.css">
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
                            <a href="{{ route('authors') . "#user-{$article->user->id}" }}" class="author__link">Читать все статьи</a>
                        </div>
                        <div class="repost"
                             data-article="{{ $article->id }}"
                             data-sum="{{ $article->star_sum }}"
                             data-cnt="{{ $article->star_count }}"
                        >
                            <div class="repost__header">
                                <div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir"></div>
                            </div>
                            <div class="repost__voting">
                                <div class="repost__voting-line">Оцените статью:</div>
                                <div class="stardom">
                                    @for($i = 1; $i<= 5; $i++)
                                        @if($i <= $article->rating)
                                            <div class="stardom__item full" data-val="{{ $i }}"></div>
                                        @else
                                            <div class="stardom__item" data-val="{{ $i }}"></div>
                                        @endif
                                    @endfor
                                </div>
                                <span class="repost__voting-resalt" id="rating-format">{{ $article->rating_format }}</span>
                            </div>
                        </div>
                        <div class="page-comment">
                            <h2 class="page-comment__title">Комментарии</h2>
                            <form class="feedback js-add-comment" action="{{ route('articles.comment.store', $article) }}">
                                <div class="feedback__box">
                                    <!--suppress HtmlFormInputWithoutLabel -->
                                    <input class="feedback__field" type="text"
                                            name="name" value="{{ auth()->user()?->name }}" placeholder="Ваше имя" required>
                                </div>
                                <div class="feedback__box">
                                    <!--suppress HtmlFormInputWithoutLabel -->
                                    <input class="feedback__field" type="email"
                                            name="email" value="{{ auth()->user()?->email }}" placeholder="Ваш E-mail" required>
                                </div>
                                <div class="feedback__message">
                                    <!--suppress HtmlFormInputWithoutLabel -->
                                    <textarea class="feedback__message-field" name="message" placeholder="Ваш отзыв" required></textarea>
                                </div>

                                <div class="feedback__color">
                                    <span class="feedback__color-line">Цвет вашего аватара:</span>
                                    @foreach(\App\Models\Comment::$avatars as $key => $avatar)
                                        <label class="feedback__color-box">
                                            <input type="radio" name="avatar_color"
                                                    class="radio" value="{{ $key }}"
                                                    @checked($loop->first)>
                                            <div class="feedback__color-custom {{ $key }}"></div>
                                        </label>
                                    @endforeach
                                </div>
                                <label class="feedback__agree">
                                    <input type="checkbox" name="agree" class="checkbox" checked>
                                    <span class="custom-checkbox"></span>
                                    <span class="feedback__agree-text">Я принимаю условия
                                        <a href="/policy"
                                           class="feedback__agree-link" target="_blank">пользовательского соглашения</a>
                                    </span>
                                </label>
                                <button class="feedback__action" type="submit">Оставить отзыв</button>
                            </form>
                            @if($article->comments->isNotEmpty())
                                <div class="comment">
                                    @foreach($article->comments as $comment)
                                        <div class="comment__item">
                                            <div class="comment__item-header">
                                                <div class="comment__item-avatar {{ $comment->avatar_color }}">
                                                    {{ $comment->first_letter_name }}
                                                </div>
                                                <div class="comment__item-box">
                                                    <div class="comment__item-date">
                                                        {{ $comment->created_at->format('d.m.Y') }}
                                                    </div>
                                                    <div class="comment__item-name">{{ $comment->name }}</div>
                                                </div>
                                            </div>
                                            <div class="comment__item-text">– {{ $comment->message }}</div>
                                        </div>

                                        @if(!empty($comment->answer))
                                            <div class="comment__answer">
                                                <div class="comment__answer-header">
                                                    <img class="comment__answer-avatar" src="/img/circle.svg" alt="Специалист {{ config('app.name') }}">
                                                    <!--width 40px height 40px-->
                                                    <div class="comment__answer-box">
                                                        <div class="comment__answer-date">{{ $comment->answered_at->format('d.m.Y') }}</div>
                                                        <div class="comment__answer-name">Специалист {{ config('app.name') }}</div>
                                                    </div>
                                                </div>
                                                <div class="comment__answer-text">– {{ $comment->answer }}</div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                            @include('partials.modal')
                        </div>
                    </div>
                    @include('partials.slider')
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="/js/article.js"></script>
    <script src="/js/comment_form.js"></script>
@endpush

