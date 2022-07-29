@extends('layouts.auth')

@section('title')Сброс пароля@endsection
@section('description')Сброс пароля@endsection

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
                <h5 class="nk-block-title">Подтвердить пароль</h5>
                <div class="nk-block-des">
                    <p>Укажите и подтвердите пароль.</p>
                </div>
            </div>
        </div><!-- .nk-block-head -->
        <form action="{{ route('password.update') }}" class="form-validate is-alter" method="post">
            @csrf
            <div class="form-group">
                <label class="form-label" for="password">Пароль</label>
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
                <label class="form-label" for="password_confirmation">Подтверждение пароля</label>
                <div class="form-control-wrap">
                    <a tabindex="-1" href="#" class="form-icon form-icon-right lg passcode-switch" data-target="password_confirmation">
                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                    </a>
                    <input type="password" class="form-control form-control-lg" id="password_confirmation" name="password_confirmation" placeholder="Подтверждение пароля" autocomplete="off" required>
                    @error('password')
                    <span id="email-error" class="invalid">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block">Сбросить пароль</button>
            </div>
        </form><!-- form -->
        <div class="form-note-s2 pt-5">
            <a href="{{ route('fuck') }}"><strong>Вернуться на страницу входа</strong></a>
        </div>
    </div><!-- .nk-block -->
@endsection