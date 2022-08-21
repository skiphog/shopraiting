<?php

/**
 * @var array $data
*/

?>
@push('styles')
    <link rel="stylesheet" href="/css/breads.css">
@endpush
<div class="breads" itemscope itemtype="https://schema.org/BreadcrumbList">
    <div class="breads__box" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a class="breads__link" href="/" itemprop="item">
            <span itemprop="name">Главная</span>
        </a>
        <meta itemprop="position" content="1" />
    </div>
    @foreach($data as $key => $item)
        <div class="breads__box" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a class="breads__link" @if(!empty($item['link']))href="{!! $item['link'] !!}"@endif itemprop="item">
                <span itemprop="name">{{ $item['title'] }}</span>
            </a>
            <meta itemprop="position" content="{{ $key + 2 }}" />
        </div>
    @endforeach
</div>