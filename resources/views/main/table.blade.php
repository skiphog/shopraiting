<?php

/**
 * @var \App\Models\Shop[] $shops
 */

?>
<div class="text">
    <h2>Таблица сравнения сексшопов</h2>
    <table>
        <tr>
            <th>Сексшопы</th>
            <th>Количество товаров</th>
            <th>Скидки</th>
            <th>Доставка</th>
            <th></th>
        </tr>

        @foreach ($shops as $shop)
            <tr>
                <td class="table__item"><a href="{{ $shop_url = route('shops.show', $shop) }}">{{ $shop->name }}</a></td>
                <td>{{ $shop->products_cnt_format }}</td>
                <td>{{ $shop->discounts }}</td>
                <td>{{ $shop->delivery_time }}</td>
                <td><a href="{{ $shop_url }}" class="table__link">Подробнее</a></td>
            </tr>
        @endforeach
    </table>
</div>