@extends('layouts.auth')

@section('title')Регистрация@endsection
@section('description')Регистрация@endsection

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
                <h5 class="nk-block-title">Регистрация</h5>
                <div class="nk-block-des">
                    <p>Создать новый аккаунт.</p>
                </div>
            </div>
        </div><!-- .nk-block-head -->
        <form action="{{ route('fuck2') }}" class="form-validate is-alter" method="post">
            @csrf
            <div class="form-group">
                <label class="form-label" for="name">Имя</label>
                <div class="form-control-wrap">
                    <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="Ваше имя" required value="{{ old('name') }}">
                    @error('name')
                    <span id="email-error" class="invalid">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <div class="form-control-wrap">
                    <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Ваш email" required value="{{ old('email') }}">
                    @error('email')
                    <span id="email-error" class="invalid">{{ $message }}</span>
                    @enderror
                </div>
            </div>
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
                <div class="custom-control custom-control-xs custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="checkbox" required>
                    @error('checkbox')
                    <span id="email-error" class="invalid">{{ $message }}</span>
                    @enderror
                    <label class="custom-control-label" for="checkbox">Я согласен с <a tabindex="-1" href="#">Условиями</a> и <a tabindex="-1" href="#"> Политикой конфиденциальности </a>{{ config('app.name') }}.</label>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block">Зарегистрироваться</button>
            </div>
        </form><!-- form -->
        <div class="form-note-s2 pt-4"> Уже есть аккаунт ? <a href="{{ route('login') }}"><strong>Войти</strong></a>
        </div>
        <div class="text-center pt-4 pb-3">
            <h6 class="overline-title overline-title-sap"><span>или</span></h6>
        </div>
        <ul class="nav justify-center gx-8">
            <li class="nav-item"><a class="nav-link" href="#">Facebook</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Google</a></li>
        </ul>
    </div>
@endsection