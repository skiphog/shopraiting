@extends('layouts.auth')

@section('title')Подтверждение почты@endsection
@section('description')Подтверждение почты@endsection

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
                <h5 class="nk-block-title">Подтверждение почты</h5>
                <div class="nk-block-des">
                    <p>Спасибо за регистрацию!<br>Прежде чем начать перейдите по ссылке из письма для подтверждения электронной почты.</p>
                    @if (session('status') === 'verification-link-sent')
                        <p>На <strong class="primary">{{ auth()->user()->email }}</strong> отправлена ссылка для подтверждения.</p>
                    @endif
                </div>
            </div>
        </div><!-- .nk-block-head -->
        <form action="{{ route('verification.send') }}" class="form-validate is-alter" method="post">
            @csrf
            <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block">Отправить повторно?</button>
            </div>
        </form><!-- form -->
        <div class="form-note-s2 pt-4"> Впервые у нас? <a href="{{ route('fuck2') }}">Создать аккаунт</a>
        </div>
        <div class="text-center pt-4 pb-3">
            <h6 class="overline-title overline-title-sap"><span>или</span></h6>
        </div>
        <ul class="nav justify-center gx-4">
            <li class="nav-item"><a class="nav-link" href="#">Facebook</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Google</a></li>
        </ul>
    </div>
@endsection