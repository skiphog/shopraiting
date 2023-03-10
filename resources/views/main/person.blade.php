<?php

/**
 * @var \App\Models\User $user
 */

?>
@push('styles')
    <link rel="stylesheet" href="/css/person.css">
@endpush
<div class="person">
    <div class="person__header">
        <picture>
            <img src="{{ asset($user->avatar) }}" width="40" height="40" alt="{{ $user->name }}">
            <!--width 40 height 40-->
        </picture>
        <div class="person__header-box">
            <div class="person__header-line">Об авторе рейтинга</div>
            <a href="{{ route('authors.show', $user) }}" class="person__header-name">{{ $user->name }}</a>
        </div>
    </div>
    <div class="person__main">
        {!! $user->description !!}
    </div>
    <div class="person__footer">
        <a href="{{ route('authors.show', $user) }}">{{ $user->name }}</a> ждёт ваших вопросов на
        <a href="mailto:{{ $user->email }}" class="person__footer-link">{{ $user->email }}</a>
    </div>
</div>