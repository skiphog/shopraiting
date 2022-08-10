<?php

/**
 * @var \App\Models\Coupon[] $coupons
 */

?>

@if($coupons->isNotEmpty())
    @push('styles')
        <link rel="stylesheet" href="/css/coupons.css">
    @endpush

    <div class="coupons-and-promotions">
        <h2>Купоны и акции</h2>
        <ul class="coupons-and-promotions__list" id="coupons-area">
            @foreach($coupons as $coupon)
                <li class="coupons-and-promotions__item">
                    <div class="coupons-and-promotions__info-block {{ $coupon->color }}">
                        <p class="coupons-and-promotions__discount-value">{{ $coupon->type_content }}</p>
                        <p class="coupons-and-promotions__caption">{{ $coupon->type_value }}</p>
                    </div>
                    <div class="coupons-and-promotions__offer-block">
                        <h4 class="coupons-and-promotions__title">
                            <a class="coupons-and-promotions__link">
                                {{ $coupon->title }}
                            </a>
                        </h4>
                        <p class="coupons-and-promotions__description">{{ $coupon->content }}</p>
                    </div>
                    <div class="coupons-and-promotions__code-block">
                        @if($coupon->isCoupon())
                            <button class="coupons-and-promotions__button"
                                    data-color="{{ $coupon->color }}"
                                    data-coupon="{{ $coupon->button_content }}"
                            >
                                <span class="coupons-and-promotions__code-part">Открыть<br>код</span>
                                <span class="coupons-and-promotions__code">{{ $coupon->button_content_trim }}</span>
                            </button>
                        @elseif($coupon->isLink())
                            <a class="coupons-and-promotions__code-link" href="{{ url($coupon->button_content) }}"
                                    target="_blank" rel="noopener noreferrer">
                                <span class="coupons-and-promotions__code-part">Получить<br>скидку</span>
                            </a>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="coupons-and-promotions__modal-mask"></div>
        <div class="coupons-and-promotions__modal" id="modal-coupon">
            <button class="coupons-and-promotions__modal-close">X</button>
            <div class="coupons-and-promotions__modal-list">
                <div class="coupons-and-promotions__modal-item">
                    <div class="coupons-and-promotions__modal-info-block">
                        <p class="coupons-and-promotions__modal-discount-value"></p>
                        <p class="coupons-and-promotions__modal-caption"></p>
                    </div>
                    <div class="coupons-and-promotions__modal-offer-block">
                        <h4 class="coupons-and-promotions__modal-title">
                            <a class="coupons-and-promotions__modal-link"></a>
                        </h4>
                        <p class="coupons-and-promotions__modal-description"></p>
                    </div>
                </div>
            </div>
            <div class="coupons-and-promotions__modal-copy">
                <label for="coupons-and-promotions__modal-input"></label>
                <input id="coupons-and-promotions__modal-input" class="coupons-and-promotions__modal-input" type="text" value="">
                <div class="coupons-and-promotions__modal-tooltip-wrapper">
                    <button class="coupons-and-promotions__modal-copy-button" onclick="getText()" onmouseout="alreadyCopied()">
                        Скопировать
                        <span class="coupons-and-promotions__modal-tooltip-text">Скопировать код</span>
                    </button>
                </div>
            </div>
            <div class="coupons-and-promotions__modal-link-wrapper">
                <a class="coupons-and-promotions__modal-link-button btn" href="#" target="_blank" rel="noopener noreferrer">Перейти на сайт</a>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="/js/coupons.js"></script>
    @endpush
@endif
