<?php

/**
 * @var \App\Models\Banner[] $banners
*/

?>
@if($banners->isNotEmpty())
    @push('styles')
        <link rel="stylesheet" href="/css/slick.css">
    @endpush
    @push('scripts')
        <script src="/js/slider-index.js"></script>
    @endpush
    <div class="index__slider">
        @foreach($banners as $key => $banner)
            <div class="banner-wrapper {{ $key > 0 ? 'hidden': '' }}" style="visibility:hidden">
                <a href="{{ url($banner->link) }}" target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset($banner->path) }}" alt="{{ $banner->name }}">
                </a>
            </div>
        @endforeach
    </div>
@endif
