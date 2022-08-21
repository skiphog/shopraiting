<?php

/**
 * @var \App\Models\Brand $brand
*/

?>
<div class="form product-form">
    <h2>{{ 'Оставить отзыв о бренде ' . $brand->name  }}</h2>
    <form class="feedback js-add-review" id="form_review" action="{{ route('reviews.store') }}">
        <!--suppress CannotResolveSymbol -->
        <div class="feedback__progress" itemscope itemtype="https://schema.org/AggregateRating">
            <meta itemprop="itemReviewed" content="Карты рассрочки>">
            <span class="line">Ваша оценка:</span>
            <div class="stars">
                <svg class="icon" width="20px" height="20px">
                    <use xlink:href="/img/sprite.svg#heart"></use>
                </svg>
                <svg class="icon" width="20px" height="20px">
                    <use xlink:href="/img/sprite.svg#heart"></use>
                </svg>
                <svg class="icon" width="20px" height="20px">
                    <use xlink:href="/img/sprite.svg#heart"></use>
                </svg>
                <svg class="icon" width="20px" height="20px">
                    <use xlink:href="/img/sprite.svg#heart"></use>
                </svg>
                <svg class="icon" width="20px" height="20px">
                    <use xlink:href="/img/sprite.svg#heart"></use>
                </svg>
                <div class="progress js-review-mark-overlay" style="width: 50%"></div>
            </div>
            <div itemprop="ratingValue" class="rating js-review-mark">5,0</div>
            <meta itemprop="ratingCount" content="10">
        </div>
        <div class="feedback__box">
            <!--suppress HtmlFormInputWithoutLabel -->
            <input type="text" class="feedback__field" placeholder="Ваше имя"
                    name="author_name" value="{{ auth()->user()?->name }}">
        </div>
        <div class="feedback__box">
            <!--suppress HtmlFormInputWithoutLabel -->
            <input type="email" class="feedback__field" placeholder="Ваш e-mail"
                    name="author_email" value="{{ auth()->user()?->email }}">
        </div>
        <div class="feedback__message">
            <!--suppress HtmlFormInputWithoutLabel -->
            <textarea class="feedback__message-field" placeholder="Ваш отзыв" name="content"></textarea>
        </div>
        <div class="progress-block">
            <div class="progress-block__item">
                <div class="progress-block__group js-progress-group">
                    <div class="progress-block__top">
                        <div class="progress-block__title">Цена</div>
                    </div>
                    <div class="progress-block__box">
                        <!--suppress HtmlUnknownAttribute -->
                        <progress min="0.0" max="10.0" step="1.0" value="5.0" class="progress-range  progress-green js-progress-value"></progress>
                        <div class="decor">
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                        </div>
                    </div>
                </div>
                <div class="progress-block__group js-progress-group">
                    <div class="progress-block__top">
                        <div class="progress-block__title">Соответствие описанию</div>
                    </div>
                    <div class="progress-block__box">
                        <!--suppress HtmlUnknownAttribute -->
                        <progress min="0.0" max="10.0" step="1.0" value="5.0" class="progress-range progress-green js-progress-value"></progress>
                        <div class="decor">
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="progress-block__item">
                <div class="progress-block__group js-progress-group">
                    <div class="progress-block__top">
                        <div class="progress-block__title">Качество</div>
                    </div>
                    <div class="progress-block__box">
                        <!--suppress HtmlUnknownAttribute -->
                        <progress min="0.0" max="10.0" step="1.0" value="5.0" class="progress-range progress-green js-progress-value"></progress>
                        <div class="decor">
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                        </div>
                    </div>
                </div>
                <div class="progress-block__group js-progress-group">
                    <div class="progress-block__top">
                        <div class="progress-block__title">Удобство</div>
                    </div>
                    <div class="progress-block__box">
                        <!--suppress HtmlUnknownAttribute -->
                        <progress min="0.0" max="10.0" step="1.0" value="5.0" class="progress-range progress-green js-progress-value"></progress>
                        <div class="decor">
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                            <div class="decor__item"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <label class="feedback__agree">
            <input type="checkbox" class="checkbox" name="agree" checked="checked">
            <span class="custom-checkbox"></span>
            <span class="feedback__agree-text">Я принимаю условия <a href="{{ route('privacy') }}" class="feedback__agree-link" target="_blank">пользовательского соглашения</a></span>
        </label>
        <input type="hidden" name="product_id" value="{{ $brand->id }}">
        <input type="hidden" name="type" value="brands">
        <input class="js-review-mark-input" type="hidden" name="rating" value="5">
        <button class="feedback__action" type="submit">Оставить отзыв</button>
    </form>
</div>
@include('partials.modal')

@push('scripts')
    <script src="/js/review_form.js"></script>
@endpush