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
                        <div class="nk-tb-col"><span class="sub-text">Магазин</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Автор</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Текст</span></div>
                        <div class="nk-tb-col tb-col-md"><em class="tb-asterisk icon ni ni-star-round"></em></div>
                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Дата</span></div>
                    </div>

                    @foreach($reviews as $review)
                        <a class="nk-tb-item" href="{{ route('admin.reviews.edit', $review) }}">
                            <div class="nk-tb-col">
                                {{ $review->shop->name }}
                            </div>
                            <div class="nk-tb-col">
                                {{ $review->author_name }}
                            </div>
                            <div class="nk-tb-col">
                                {{ str($review->content)->limit(120) }}
                            </div>

                            <div class="nk-tb-col tb-col-md"><span>{{ $review->rating_format }}</span></div>
                            <div class="nk-tb-col tb-col-md"><span>{{ $review->created_at->format('d-m-Y H:i') }}</span></div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
