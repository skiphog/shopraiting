<?php

/**
 * @var \App\Models\City[]|\Illuminate\Database\Eloquent\Collection $cities
 */

?>
<div class="text">
    <div class="popularity">
        <h2>Все города</h2>
        <div class="popularity__filter-block">
            <div class="popularity__total">Всего {{ $cnt = $cities->count() }} {{ trans_choice('dic.cities', $cnt) }}</div>
        </div>
        @if($cities->isNotEmpty())
            <div class="popularity__box">
                @foreach ($cities->chunk(ceil($cnt / 3)) as $chunk)
                    <div class="popularity__box-wrap">
                        <div class="popularity__item">
                            @foreach ($chunk as $city)
                                <a href="{{ route('cities.show', $city) }}" class="popularity__item-link">{{ $city->name }}</a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Нет городов</p>
        @endif
    </div>
</div>