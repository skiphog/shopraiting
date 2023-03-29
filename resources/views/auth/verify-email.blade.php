@extends('layouts.auth')

@section('title', 'Подтверждение почты')
@section('description', 'Подтверждение почты')

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
                <h5 class="nk-block-title">Подтверждение почты</h5>
                <div class="nk-block-des">
                    <p>Спасибо за регистрацию!
                        <br>
                        Чтобы получить доступ ко всем возможностям сервиса, перейдите по ссылке в письме и подтвердите свой адрес электронной почты.</p>
                </div>
                @if (session('status') === 'verification-link-sent')
                    <div class="alert alert-success alert-icon mt-2">
                        <em class="icon ni ni-check-circle"></em>
                        На <strong>{{ auth()->user()->email }}</strong>
                        отправлена ссылка для подтверждения.
                    </div>
                @endif
            </div>
        </div>
        <form action="{{ route('verification.send') }}" class="form-validate is-alter" method="post">
            @csrf
            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary btn-block">Отправить повторно?</button>
            </div>
        </form>
    </div>
@endsection