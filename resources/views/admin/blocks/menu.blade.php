<div class="nk-sidebar nk-sidebar-fixed is-dark" data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-menu-trigger">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu">
                <em class="icon ni ni-arrow-left"></em>
            </a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu">
                <em class="icon ni ni-menu"></em>
            </a>
        </div>
        <div class="nk-sidebar-brand">
            <a href="{{ route('admin.index') }}" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="/dashboard/images/logo.png"
                     srcset="/dashboard/images/logo2x.png 2x" alt="logo">
                <img class="logo-dark logo-img" src="/dashboard/images/logo-dark.png"
                     srcset="/dashboard/images/logo-dark2x.png 2x" alt="logo-dark">
            </a>
        </div>
    </div>
    <div class="nk-sidebar-element nk-sidebar-body">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-heading"><h6 class="overline-title text-primary-alt">Панель управления</h6></li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                            <span class="nk-menu-text">Каталог</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('admin.shops.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-cart"></em></span>
                                    <span class="nk-menu-text">Магазины</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('admin.brands.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-book"></em></span>
                                    <span class="nk-menu-text">Бренды</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('admin.pages.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-list-round"></em></span>
                                    <span class="nk-menu-text">Страницы</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('admin.cities.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-building"></em></span>
                                    <span class="nk-menu-text">Города</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-template"></em></span>
                            <span class="nk-menu-text">Блог</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('admin.articles.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-card-view"></em></span>
                                    <span class="nk-menu-text">Статьи</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('admin.comments.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-comments"></em></span>
                                    <span class="nk-menu-text">Комментарии</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('admin.reviews.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-files"></em></span>
                            <span class="nk-menu-text">Отзывы</span>
                        </a>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-cmd"></em></span>
                            <span class="nk-menu-text">Разное</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('admin.questions.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-question"></em></span>
                                    <span class="nk-menu-text">Вопросы</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('admin.users.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-user-alt"></em></span>
                            <span class="nk-menu-text">Пользователи</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('admin.banners.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-view-x7"></em></span>
                            <span class="nk-menu-text">Баннеры</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('admin.settings.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-setting-alt"></em></span>
                            <span class="nk-menu-text">Настройки</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>