<?php

/**
 * @var \App\Models\Banner[] $banners
*/

?>
@if($banners->isNotEmpty())
    @foreach($banners as $banner)
        <div class="banner-wrapper">
            <a href="{{ url($banner->link) }}" target="_blank" rel="noopener noreferrer">
                <img src="{{ asset($banner->path) }}" alt="{{ $banner->name }}">
            </a>
        </div>
    @endforeach
@endif
