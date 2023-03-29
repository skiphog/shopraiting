@extends('layouts.auth')

@section('title', 'Регистрация')
@section('description', 'Регистрация')

@section('content')
    <div class="nk-block nk-block-middle nk-auth-body">
        <div class="brand-logo pb-5">
            <a href="{{ route('index') }}" class="logo-link">
                <img class="logo-dark logo-img logo-img-lg" src="/dashboard/images/logo.svg" alt="logo-dark">
                <span class="header__logo-name _white">Sexshop</span><span class="header__logo-name _dark-blue">Rating</span>
            </a>
        </div>
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 class="nk-block-title">Регистрация</h5>
                <div class="nk-block-des">
                    <p>Создать новый аккаунт</p>
                </div>
            </div>
        </div>

        <form action="{{ route('register.store') }}" class="crutch-validate is-alter" method="post">
            <div class="form-group">
                <label class="form-label" for="name">Имя</label>
                <div class="form-control-wrap">
                    <input type="text" class="form-control form-control-lg" id="name" name="name"
                            placeholder="Ваше Имя" required>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <div class="form-control-wrap">
                    <input type="email" class="form-control form-control-lg" id="email" name="email"
                            placeholder="Ваш email" required>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Пароль</label>
                <div class="form-control-wrap">
                    <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                    </a>
                    <input type="password" class="form-control form-control-lg" id="password" name="password"
                            placeholder="Ваш пароль" required>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="password_confirmation">Подтверждение пароля</label>
                <div class="form-control-wrap">
                    <a tabindex="-1" href="#" class="form-icon form-icon-right lg passcode-switch" data-target="password_confirmation">
                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                    </a>
                    <input type="password" class="form-control form-control-lg" id="password_confirmation"
                            name="password_confirmation" placeholder="Подтвердите пароль" required>
                </div>
            </div>
            <div class="form-group">
                <div class="custom-control custom-control-xs custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="tos" name="tos" required checked>
                    <label class="custom-control-label" for="tos">
                        Я согласен с
                        <a tabindex="-1" href="{{ route('privacy') }}">
                            пользовательским соглашением
                        </a>
                        {{ config('app.name') }}.
                    </label>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary btn-block">Зарегистрироваться</button>
            </div>
        </form>

        <div class="form-note-s2 pt-4">
            Уже есть аккаунт?
            <a href="{{ route('login') }}"><strong>Войти</strong></a>
        </div>
    </div>
@endsection