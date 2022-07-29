<!doctype html>
<html lang="ru" class="js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('description', 'Панель управления')">
    <link rel="stylesheet" href="/dashboard/css/app.css?v=3">
    @stack('style')
    <title>@yield('title', config('app.name'))</title>
</head>
<body class="nk-body bg-lighter npc-general has-sidebar">
<div class="nk-app-root">
    <div class="nk-main">
        @include('admin.blocks.menu')
        <div class="nk-wrap ">
            <div class="nk-header nk-header-fixed is-light">
                <div class="container-fluid">
                    <div class="nk-header-wrap">
                        <div class="nk-menu-trigger d-xl-none ml-n1">
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                        </div>
                        <div class="nk-header-brand d-xl-none">
                            <a href="{{ route('admin.index') }}" class="logo-link">
                                <img class="logo-light logo-img" src="/dashboard/images/logo.png" srcset="/dashboard/images/logo2x.png 2x" alt="logo">
                                <img class="logo-dark logo-img" src="/dashboard/images/logo-dark.png" srcset="/dashboard/images/logo-dark2x.png 2x" alt="logo-dark">
                            </a>
                        </div>
                        @include('admin.blocks.news')
                        @include('admin.blocks.auth')
                    </div>
                </div>
            </div>

            <div class="nk-content ">
                <div class="container-fluid">
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
                            {{--<ul class="nav nav-sm">
                                <li class="nav-item"><a class="nav-link" href="{{ url('/terms') }}">Условия использования</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ url('/privacy') }}">Политика конфиденциальности</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ url('/help') }}">Центр помощи</a></li>
                            </ul>--}}
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