<?php

/**
 * @var \App\Models\Shop[] $shops
 */
?>
<div class="nk-block">
    <div class="card card-bordered card-stretch">
        <div class="card-inner-group">
            <div class="card-inner p-0">
                <div class="nk-tb-list nk-tb-ulist">
                    <div class="nk-tb-item nk-tb-head">
                        <div class="nk-tb-col"><span class="sub-text">Название</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Рейтинг</span></div>
                        <div class="nk-tb-col tb-col-sm"><span class="sub-text">Отзывы</span></div>

                        <div class="nk-tb-col nk-tb-col-tools text-right">
                            <em class="icon ni ni-setting-alt"></em>
                        </div>
                    </div>

                    @foreach($shops as $shop)
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <a href="{{ route('admin.shops.edit', $shop) }}"><span class="fw-medium">{{ $shop->name }}</span></a>
                            </div>
                            <div class="nk-tb-col">
                                <span class="fw-medium">{{ $shop->rating_value_format }}</span>
                            </div>
                            <div class="nk-tb-col tb-col-sm"><span>{{ $shop->reviews_count }}</span></div>

                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li class="nk-tb-action-hidden">
                                        <a href="{{ route('admin.shops.edit', $shop) }}" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Редактировать"><em class="icon ni ni-edit-fill"></em></a>
                                    </li>
                                    <li class="nk-tb-action-hidden">
                                        <a href="{{ route('shops.show', $shop) }}" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Посмотреть на сайте" target="_blank"><em class="icon ni ni-eye-fill"></em></a>
                                    </li>
                                    <li class="nk-tb-action-hidden">
                                        <a href="#" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Move To Trash"><em class="icon ni ni-trash-fill"></em></a>
                                    </li>
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li>
                                                        <a href="#"><em class="icon ni ni-eye-fill"></em><span>View Page</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="#" data-toggle="modal" data-target="#editPage"><em class="icon ni ni-edit-fill"></em><span>Edit Page</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="#"><em class="icon ni ni-trash-fill"></em><span>Trash</span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
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