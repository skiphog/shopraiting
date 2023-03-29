<?php

/**
 * @var \App\Models\User $user
*/

?>
<!doctype html>
<html lang="ru" class="js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('description', 'Кабинет')">

    <!-- <link rel="apple-touch-icon" sizes="180x180" href="/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicons/favicon-16x16.png">
    -->

    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="stylesheet" href="/dashboard/css/app.css?v=2">
    <link rel="stylesheet" href="/dashboard/css/crutchstyle.css?v=1">
    @stack('style')
    <title>@yield('title', 'Кабинет')</title>
</head>
<body class="nk-body bg-lighter npc-general has-sidebar">
<div class="nk-app-root">
    <div class="nk-main">
        <div class="nk-wrap ">
            <div class="nk-header nk-header-fixed is-light">
                <div class="container-fluid">
                    <div class="nk-header-wrap">
                        <div class="nk-header-brand">
                            <a href="{{ route('cabinet.index') }}" class="logo-link">
                                <img class="logo-dark logo-img logo-img-lg" src="/dashboard/images/logo.svg" alt="logo-dark">
                                <span class="header__logo-name _white">Sexshop</span><span class="header__logo-name _dark-blue">Rating</span>
                            </a>
                        </div>
                        <div class="nk-header-news d-none d-xl-block">
                            <div class="nk-news-list">
                                <a class="nk-news-item" href="#" onclick="return false;">
                                    <div class="nk-news-icon"><em class="icon ni ni-card-view"></em></div>
                                    <div class="nk-news-text">
                                        <p>Текущая дата: <span>{{ date('d.m.Y') }}</span></p>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="nk-header-tools">
                            <ul class="nk-quick-nav">
                                <li class="dropdown user-dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <div class="user-toggle">
                                            <div class="user-avatar sm">
                                                <em class="icon ni ni-user-alt"></em>
                                            </div>
                                            <div class="user-info d-none d-md-block">
                                                <div class="user-status">{{ $user->role_name }}</div>
                                                <div class="user-name dropdown-indicator">{{ $user->name }}</div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                                        <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                            <div class="user-card">
                                                <div class="user-avatar">
                                                    <span>{{ mb_substr($user->name, 0, 1) }}</span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text">{{ $user->name }}</span>
                                                    <span class="sub-text">{{ $user->email }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li><a href="{{ route('cabinet.profile.index') }}"><em class="icon ni ni-user-list"></em><span>Профиль</span></a></li>
                                                @if($user->isAdmin())
                                                    <li><a href="{{ route('admin.index') }}"><em class="icon ni ni-account-setting-alt"></em><span>Панель</span></a></li>
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li>
                                                    <form action="{{ route('logout') }}" method="post" onsubmit="return confirm('Выйти?')">
                                                        <button type="submit" class="btn btn-icon">
                                                            <em class="icon ni ni-signout"></em> Выход
                                                        </button>
                                                        @csrf
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <div class="nk-content nk-content-fluid">
                <div class="container-xl wide-xl">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            <div class="nk-footer">
                <div class="container-fluid">
                    <div class="nk-footer-wrap">
                        <div class="nk-footer-copyright"> &copy; {{ date('Y') }} <a href="" target="_blank">{{ config('app.name') }}</a>
                        </div>
                        <div class="nk-footer-links">
                            <ul class="nav nav-sm">
                                <li class="nav-item"><a class="nav-link" href="{{ route('privacy') }}">Пользовательское соглашение</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@yield('modal')
<script src="/dashboard/js/bundle.js"></script>
<script src="/dashboard/js/scripts.js"></script>
@if(session('flash'))
    <script>
      Swal.fire(
        "{{ session('flash.title', '👌') }}",
        "{{ session('flash.message', 'Yea!') }}",
        "{{ session('flash.type', 'success') }}",
      );
    </script>
@endif
@stack('script')
</body>
</html>