<?php

/**
 * @var \App\Models\Review[] $reviews
 */

?>
<div class="nk-block">
    <div class="card card-bordered card-stretch">
        <div class="card-inner-group">
            <div class="card-inner p-0">
                <div class="nk-tb-list nk-tb-ulist">
                    <div class="nk-tb-item nk-tb-head">
                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Продукт</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Название</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Автор</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Текст</span></div>
                        <div class="nk-tb-col tb-col-md"><em class="tb-asterisk icon ni ni-star-round"></em></div>
                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Дата</span></div>
                    </div>

                    @foreach($reviews as $review)
                        <div class="nk-tb-item">
                            <div class="nk-tb-col tb-col-md">
                                {{ $review->product->type_text }}
                            </div>
                            <div class="nk-tb-col">
                                <a class="fw-bold" href="{{ route('admin.reviews.edit', $review) }}">
                                    {{ $review->product->name }}
                                </a>
                            </div>
                            <div class="nk-tb-col">
                                {{ $review->author_name }}
                            </div>
                            <div class="nk-tb-col">
                                {{ str($review->content)->limit(120) }}
                            </div>

                            <div class="nk-tb-col tb-col-md">
                                <span class="{{ $review->isNegative() ? 'text-danger' : 'text-success' }}">
                                    {{ $review->rating_format }}
                                </span>
                            </div>
                            <div class="nk-tb-col tb-col-md"><span>{{ $review->created_at->format('d-m-Y H:i') }}</span></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
