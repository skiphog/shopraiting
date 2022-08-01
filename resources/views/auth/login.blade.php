@extends('layouts.auth')

@section('title', 'Вход')
@section('description', 'Вход')

@section('content')
    <div class="nk-block nk-block-middle nk-auth-body">
        <div class="brand-logo pb-5">
            <a href="{{ route('index') }}" class="logo-link">
                <img class="logo-light logo-img logo-img-lg" src="/dashboard/images/logo.png" alt="logo">
                <img class="logo-dark logo-img logo-img-lg" src="/dashboard/images/logo-dark.png" alt="logo-dark">
            </a>
        </div>
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 class="nk-block-title">Войти</h5>
                <div class="nk-block-des">
                    <p>Для входа используйте свой email и пароль.</p>
                </div>
            </div>
        </div><!-- .nk-block-head -->
        <form action="{{ route('login.auth') }}" class="form-validate is-alter" method="post">
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
    </div>
@endsection