<?php

/**
 * @var \App\Models\Banner[] $banners
 */

?>
<div class="nk-block">
    <div class="card card-bordered card-stretch">
        <div class="card-inner-group">
            <div class="card-inner p-0">
                <div class="nk-tb-list nk-tb-ulist">
                    <div class="nk-tb-item nk-tb-head">
                        <div class="nk-tb-col"><span class="sub-text">Название</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Link</span></div>
                        <div class="nk-tb-col"><span class="sub-text"></span></div>
                    </div>

                    @foreach($banners as $banner)
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <a href="{{ route('admin.banners.edit', $banner) }}">
                                    <span class="fw-medium">{{ $banner->name }}</span>
                                </a>
                            </div>
                            <div class="nk-tb-col">
                                <span>{{ $banner->link }}</span>
                            </div>
                            <div class="nk-tb-col {{ $banner->isActivity() ? 'text-success' : 'text-danger' }} text-right">
                                <span>{{ $banner->status_text }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>