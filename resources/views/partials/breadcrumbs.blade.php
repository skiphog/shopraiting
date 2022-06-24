<?php

/**
 * @var array $data
*/

?>
<div class="breads">
    <div class="breads__box"><a href="/" class="breads__link">Главная</a></div>
    @foreach($data as $item)
        <div class="breads__box">
            <a class="breads__link" @if(!empty($item['link']))href="{!! $item['link'] !!}"@endif>{{ $item['title'] }}</a>
        </div>
    @endforeach
</div>