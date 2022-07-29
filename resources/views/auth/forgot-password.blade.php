@extends('layouts.auth')

@section('title')Восстановление пароля@endsection
@section('description')Восстановление пароля@endsection

@section('content')
    <div class="nk-block nk-block-middle nk-auth-body">
        <div class="brand-logo pb-5">
            <a href="{{ route('home') }}" class="logo-link">
                <img class="logo-light logo-img logo-img-lg" src="/img/core-img/logo-white.png" alt="logo">
                <img class="logo-dark logo-img logo-img-lg" src="/img/core-img/logo.png" alt="logo-dark">
            </a>
        </div>
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 class="nk-block-title">Восстановить пароль</h5>
                <div class="nk-block-des">
                    <p>Если вы забыли свой пароль, тогда мы вышлем вам инструкции по восстановлению доступа на указанный email.</p>
                </div>
            </div>
        </div><!-- .nk-block-head -->
        <form action="{{ route('password.email') }}" class="form-validate is-alter" method="post">
            @csrf
            <div class="form-group">
                <div class="form-label-group">
                    <label class="form-label" for="email">Email</label>
                    <a class="link link-primary link-sm" href="#">Нужна помощь?</a>
                </div>
                <div class="form-control-wrap">
                    <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Ваш email" required value="{{ old('email') }}">
                    @error('email')
                    <span id="email-error" class="invalid">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block">Восстановить доступ</button>
            </div>
        </form><!-- form -->
        <div class="form-note-s2 pt-5">
            <a href="{{ route('fuck') }}"><strong>Вернуться на страницу входа</strong></a>
        </div>
    </div><!-- .nk-block -->
@endsection