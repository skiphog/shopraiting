@extends('layouts.app')

@section('title', 'Контакты сайта ' . config('app.url'))
@section('description', 'Контакты сайта ' . config('app.url'))

@push('styles')
    <link rel="stylesheet" href="/css/feedback.css">
    <link rel="stylesheet" href="/css/contacts.css">
    <link rel="stylesheet" href="/css/custom.css">
@endpush

@section('content')
    <main class="main">
        <div class="inner-back">
            <div class="wrap">
                @include('partials.breadcrumbs', ['data' => [['link' => '', 'title' => 'Контакты']]])
                <h1>Контакты</h1>

                <div class="content">
                    @include('partials.slider')
                    <div class="main-content">
                        <div class="contacts">
                            <div class="feedback__text">
                                Здесь вы можете задать нам любой вопрос или предложить идею для совместного сотрудничества.
                            </div>
                            <form class="feedback js-add-comment" method="post" action="{{ route('questions.store') }}">
                                <div class="feedback__title">Задать вопрос</div>
                                <div class="feedback__box">
                                    <!--suppress HtmlFormInputWithoutLabel -->
                                    <input class="feedback__field" type="text" name="name"
                                            placeholder="Ваше имя" value="{{ auth()->user()?->name }}">
                                </div>
                                <div class="feedback__box">
                                    <!--suppress HtmlFormInputWithoutLabel -->
                                    <input class="feedback__field" type="email" name="email"
                                            placeholder="Ваш e-mail" value="{{ auth()->user()?->email }}">
                                </div>
                                <div class="feedback__message">
                                    <!--suppress HtmlFormInputWithoutLabel -->
                                    <textarea class="feedback__message-field" name="message" placeholder="Ваш вопрос"></textarea>
                                </div>
                                <label class="feedback__agree">
                                    <input type="checkbox" class="checkbox" name="agree" checked>
                                    <span class="custom-checkbox"></span>
                                    <span class="feedback__agree-text">Я принимаю условия
                                        <a href="/policy" class="feedback__agree-link" target="_blank">
                                            пользовательского соглашения
                                        </a>
                                    </span>
                                </label>
                                <button class="feedback__action" type="submit">Оставить вопрос</button>
                            </form>
                            @include('partials.modal')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="/js/comment_form.js"></script>
@endpush