<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    @hasSection('canonical')
        <link rel="canonical" href="@yield('canonical')">
    @endif
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:image" content="{{ asset('img/sexshoprating.png') }}">
    <meta name="yandex-verification" content="5e4b7507460c3529">
    <meta name="verify-admitad" content="1cb707051c">
    <meta name="verify-advertiseru" content="b0e06fc117">
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/breads.css">
    <link rel="stylesheet" href="/css/pagination.css">
    @stack('styles')
    @includeWhen(app()->isProduction(), 'layouts.metrics.google_tag_manager')
</head>
<body>
@includeWhen(app()->isProduction(), 'layouts.metrics.google_tag_iframe')
<header class="header">
    <div class="header__box">
        <a class="header__logo" href="/">
            <picture>
                <source media="(min-width: 960px )" srcset="/img/logo.svg">
                <img src="/img/logo.svg" alt="{{ config('app.name') }}">
            </picture>
            <div class="header__logo-wrap">
                <span class="header__logo-name _white">Sexshop</span><span class="header__logo-name _dark-blue">Rating</span>
            </div>
        </a>
        <a href="mailto:{{ config('mail.from.address') }}" class="header__mail-icon" target="_blank" rel="noopener noreferrer"></a>
        <div class="header__btn">
            <input class="header-btn__link" id="toggle" type="checkbox">
            <label class="toggle-box" for="toggle">
                <span class="burger burger-toggle"></span>
            </label>
        </div>
    </div>
    <nav class="nav">
        <div class="nav__wrapper">
            <button type="button" class="nav__item nav__item-rating">Сексшопы
                <svg class="icon" width="8px" height="8px">
                    <use xlink:href="/img/sprite.svg#arrdwn"></use>
                </svg>
            </button>
            {{-- Получить 5 магазинов отсортированных по позиции --}}
            <div class="nav__sub">
                <a href="/bestsexshop" class="nav__sub-link">Лучший секс шоп</a>
                <a href="/intimshop" class="nav__sub-link">IntimShop</a>
                <a href="/rozovii-krolik" class="nav__sub-link">Розовый кролик</a>
                <a href="/uslada" class="nav__sub-link">Услада</a>
                <a href="/tigramur" class="nav__sub-link">Tigramur</a>
                <a href="/ratings" class="nav__sub-link">Все магазины</a>
            </div>
        </div>
        <div class="nav__box">
            <a class="nav__link" href="/reviews">Отзывы</a>
            <a class="nav__link" href="/articles">Статьи</a>
        </div>
        <a href="/#showcase" class="nav__link-btn">Лучшие сексшопы</a>
        <a href="mailto:{{ config('mail.from.address') }}" class="nav__link-btn nav__link-btn--mail" target="_blank" rel="noopener noreferrer">{{ config('mail.from.address') }}</a>
    </nav>
</header>
@yield('content')
<footer class="footer">
    <div class="wrap">
        <a href="/" class="footer__logo">
            <picture>
                <source media="(min-width: 960px )" srcset="/img/logo.svg">
                <img src="/img/logo.svg" alt="{{ config('app.name') }}"/>
            </picture>
            <div class="header__logo-wrap">
                <span class="header__logo-name _footer-dark-pink">Sexshop</span><span class="header__logo-name _footer-dark-blue">Rating</span>
            </div>
        </a>

        <nav class="footer__nav">
            <a class="footer__nav-link" href="/feedback">Контакты</a>
            <a class="footer__nav-link" href="/questions">Вопросы</a>
            <a class="footer__nav-link" href="/authors">Авторы</a>
            <a class="footer__nav-link" href="/about">О нас</a>
            @auth
                <a class="footer__nav-link" href="/cabinet">Кабинет</a>
            @else
                <a class="footer__nav-link" href="/auth">Войти</a>
            @endauth
        </nav>

        <div class="footer__text">
            Вся представленная на сайте информация, касающаяся описаний сайтов, их продукции и стоимости товаров и услуг,
            носит информационный характер и ни при каких условиях не является публичной офертой, определяемой положениями
            Статьи 437 (2) Гражданского кодекса РФ
        </div>
        <div class="footer__copirate">© {{ config('app.name') }}, {{ date('Y') }}</div>
        <a href="mailto:{{ config('mail.from.address') }}" class="footer__copirate-link" target="_blank" rel="noopener noreferrer">{{ config('mail.from.address') }}</a>
        <a href="/privacy" class="footer__copirate-link">Пользовательское соглашение</a>
    </div>
</footer>
@yield('modals')
<script src="/js/jquery-3.3.1.min.js"></script>
@production
    <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
    <script src="//yastatic.net/share2/share.js"></script>
@endproduction
<script src="/js/slick.min.js"></script>
<script src="/js/select2.min.js"></script>
<script src="/js/picturefill.js"></script>
<script src="/js/svgxuse.min.js"></script>
<script src="/js/main.js"></script>
@stack('scripts')
@production
    @include('layouts.metrics.yandex_metric')
    @include('layouts.metrics.google_analytics')
@endproduction
</body>
</html>