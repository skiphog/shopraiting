<?php

/**
 * @var \App\Models\City[]|\Illuminate\Database\Eloquent\Collection $cities
 * @var \App\Models\Shop[]                                          $shops
 */

?>
<div class="text">
    <div class="popularity">
        <h2>Сексшопы {{ $cities->firstWhere('slug', $request_city = request('city'))?->name }}</h2>
        <div style="display: flex; justify-content: space-between;">
            <div>Всего {{ $cnt = $shops->count() }} {{ trans_choice('dic.shops', $cnt) }}</div>
            <div style="display: flex;">
                <label for="city">Город</label>
                <div style="margin-left: 10px;">
                    <select name="city" id="city" style="outline: 0; border-radius: 4px;border: 1px solid #d6d6d6;">
                        <option value="{{ route('shops.index') }}">Все</option>
                        @foreach($cities as $city)
                            <option value="{{ route('shops.index', ['city' => $city->slug]) }}"
                                    @selected($request_city === $city->slug)>{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        @if($shops->isNotEmpty())
            <div class="popularity__box">
                @foreach ($shops->chunk(ceil($shops->count() / 3)) as $chunk)
                    <div class="popularity__box-wrap">
                        <div class="popularity__item">
                            @foreach ($chunk as $shop)
                                <a href="{{ route('shops.show', $shop) }}" class="popularity__item-link">{{ $shop->name }}</a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Нет магазинов</p>
        @endif
    </div>

</div>