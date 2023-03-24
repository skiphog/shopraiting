@extends('layouts.auth')

@section('title', 'Восстановление пароля')
@section('description', 'Восстановление пароля')

@section('content')
    <div class="nk-block nk-block-middle nk-auth-body">
        <div class="brand-logo pb-5">
            <a href="{{ route('index') }}" class="logo-link">
                <img class="logo-light logo-img logo-img-lg" src="/dashboard/images/logo.png" alt="logo">
                <img class="logo-dark logo-img logo-img-lg" src="/dashboard/images/logo-dark.png" alt="logo-dark">
            </a>
        </div>
        @if (session('status'))
            <div class="alert alert-success alert-icon">
                <em class="icon ni ni-check-circle"></em>
                {{ session('status') }}
            </div>
        @else
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">Восстановление пароля</h5>
                    <div class="nk-block-des">
                        <p>Если вы забыли свой пароль, тогда мы вышлем вам инструкции по восстановлению доступа на указанный email.</p>
                    </div>
                    @error('email')
                    <div class="alert alert-icon alert-danger mt-2" role="alert">
                        <em class="icon ni ni-alert-circle"></em>
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <form action="{{ route('password.email') }}" class="form-validate is-alter" method="post">
                @csrf
                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="email">Email</label>
                        <a class="link link-primary link-sm" href="#">Нужна помощь?</a>
                    </div>
                    <div class="form-control-wrap">
                        <input type="email" class="form-control form-control-lg" id="email" name="email"
                                placeholder="Ваш email" value="{{ old('email') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-lg btn-primary btn-block">Восстановить доступ</button>
                </div>
            </form>
            <div class="form-note-s2 pt-5">
                <a href="{{ route('login') }}"><strong>Вернуться на страницу входа</strong></a>
            </div>
        @endif
    </div>
@endsection