<?php

/**
 * @var App\Models\User       $user
 * @var App\Models\Review[]   $reviews
 * @var App\Models\Comment[]  $comments
 * @var App\Models\Question[] $questions
 */

?>
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
                            <span>А</span>
                        </div>
                        <div class="user-info">
                            <span class="lead-text">{{ $user->name }}</span>
                            <span class="sub-text">{{ $user->email }}</span>
                        </div>
                    </div>
                </div>
                <div class="dropdown-inner">
                    <ul class="link-list">
                        <li><a href="#"><em class="icon ni ni-user-alt"></em><span>Кабинет</span></a></li>
                        <li><a href="#"><em class="icon ni ni-setting-alt"></em><span>Настройки</span></a></li>
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

        @if($reviews->isNotEmpty() || $comments->isNotEmpty() || $questions->isNotEmpty())
            <li class="dropdown notification-dropdown mr-n1">
                <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                    <div class="icon-status icon-status-info"><em class="icon ni ni-bell"></em></div>
                </a>
                <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right dropdown-menu-s1">
                    <div class="dropdown-head">
                        <span class="sub-title nk-dropdown-title">Ожидают модерацию</span>
                    </div>

                    <div class="dropdown-body">
                        <div class="nk-notification">
                            @foreach($reviews as $review)
                                <div class="nk-notification-item dropdown-inner">
                                    <div class="nk-notification-icon">
                                        <em class="icon icon-circle bg-primary-dim ni ni-files"></em>
                                    </div>
                                    <div class="nk-notification-content">
                                        <div class="nk-notification-text">
                                            <a href="{{ route('admin.reviews.edit', $review) }}">
                                                Отзыв к «{{ $review->shop->name }}»
                                            </a>
                                        </div>
                                        <div class="nk-notification-time">{{ $review->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            @endforeach

                            @foreach($comments as $comment)
                                <div class="nk-notification-item dropdown-inner">
                                    <div class="nk-notification-icon">
                                        <em class="icon icon-circle bg-success-dim ni ni-comments"></em>
                                    </div>
                                    <div class="nk-notification-content">
                                        <div class="nk-notification-text">
                                            <a href="{{ route('admin.comments.edit', $comment) }}">
                                                Комментарий к статье от {{ $comment->name }}
                                            </a>
                                        </div>
                                        <div class="nk-notification-time">{{ $comment->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            @endforeach

                            @foreach($questions as $question)
                                <div class="nk-notification-item dropdown-inner">
                                    <div class="nk-notification-icon">
                                        <em class="icon icon-circle bg-warning-dim ni ni-question"></em>
                                    </div>
                                    <div class="nk-notification-content">
                                        <div class="nk-notification-text">
                                            <a href="{{ route('admin.questions.edit', $question) }}">
                                                Вопрос от {{ $question->name }}
                                            </a>
                                        </div>
                                        <div class="nk-notification-time">{{ $question->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </li>
        @endif
    </ul>
</div>