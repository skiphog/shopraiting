@extends('layouts.auth')

@section('title', 'Вход')
@section('description', 'Вход')

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
                <h5 class="nk-block-title">Войти</h5>
                <div class="nk-block-des">
                    <p>Для входа используйте свой email и пароль.</p>
                </div>
            </div>
        </div>
        <form action="{{ route('login.store') }}" class="form-validate is-alter" method="post">
            @csrf
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <div class="form-control-wrap">
                    <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Ваш email" value="{{ old('email') }}" required>
                    @error('email')
                        <span id="email-error" class="invalid">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="form-label-group">
                    <label class="form-label" for="password">Пароль</label>
                    <a class="link link-primary link-sm" tabindex="-1" href="{{ route('password.request') }}">Забыли пароль?</a>
                </div>
                <div class="form-control-wrap">
                    <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                    </a>
                    <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Ваш пароль" autocomplete="off" required>
                    @error('password')
                        <span id="email-error" class="invalid">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block">Войти</button>
            </div>
        </form>
        <div class="form-note-s2 pt-4">
            Впервые у нас? <a href="{{ route('register') }}">Создать аккаунт</a>
        </div>
    </div>
@endsection