<?php

/**
 * @var \App\Models\User[]|\Illuminate\Database\Eloquent\Collection $users
 */

?>
<div class="text">
    <div class="popularity">
        <h2>Авторы</h2>
        <div class="popularity__filter-block">
            <div class="popularity__total">Всего {{ $cnt = $users->count() }} {{ trans_choice('dic.user', $cnt) }}</div>
        </div>
        @if($users->isNotEmpty())
            <div class="popularity__box">
                @foreach ($users->chunk(ceil($cnt / 3)) as $chunk)
                    <div class="popularity__box-wrap">
                        <div class="popularity__item">
                            @foreach ($chunk as $user)
                                <div class="popularity__item-combiner">
                                    <img class="popularity__item-img" src="{{ $user->avatar }}" width="40" height="40" alt="person">
                                    <a href="{{ $user->getUrl() }}" class="popularity__item-link">{{ $user->name }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Нет авторов</p>
        @endif
    </div>
</div>