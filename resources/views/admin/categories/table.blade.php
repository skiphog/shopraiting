<?php

/**
 * @var \App\Models\Category[] $categories
 */
?>
<div class="nk-block">
    <div class="card card-bordered card-stretch">
        <div class="card-inner-group">
            <div class="card-inner p-0">
                <div class="nk-tb-list nk-tb-ulist">
                    <div class="nk-tb-item nk-tb-head">
                        <div class="nk-tb-col"><span class="sub-text">Название</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Slug</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Магазины</span></div>
                        <div class="nk-tb-col nk-tb-col-tools text-right">
                            <em class="icon ni ni-setting-alt"></em>
                        </div>
                    </div>

                    @foreach($categories as $category)
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <a href="{{ route('admin.categories.edit', $category) }}">
                                    <span class="fw-medium">{{ $category->name }}</span>
                                </a>
                            </div>
                            <div class="nk-tb-col">
                                <span>{{ $category->slug }}</span>
                            </div>
                            <div class="nk-tb-col"><span>{{ $category->shops_count }}</span></div>

                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li class="nk-tb-action-hidden">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Редактировать"><em class="icon ni ni-edit-fill"></em></a>
                                    </li>
                                    <li class="nk-tb-action-hidden">
                                        <a href="{{ route('categories.show', $category) }}" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Посмотреть на сайте" target="_blank"><em class="icon ni ni-eye-fill"></em></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>