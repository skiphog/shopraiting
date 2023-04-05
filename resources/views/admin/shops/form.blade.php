<?php

/**
 * @var \App\Models\Shop $shop
 */
?>
@push('style')
    <link rel="stylesheet" href="/dashboard/css/summernote.css">
    <link rel="stylesheet" href="/dashboard/css/crutch-zone.css">
    <link rel="stylesheet" href="/dashboard/css/crutch-summernote.css">
@endpush

@section('content')
    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Панель</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.shops.index') }}">Магазины</a></li>
            <li class="breadcrumb-item active">{{ $shop->id ? 'Редактирование' : 'Добавление' }}</li>
        </ul>
    </nav>

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">
                    {{ $shop->id ? $shop->name : 'Добавить магазин' }}
                </h3>
            </div>
        </div>
    </div>
    @if($shop->id)
        <p class="lead">
            <span>Купоны и акции: {{ $shop->coupons_count }}</span>
            <span class="icon ni ni-chevrons-right"></span>
            <a href="{{ route('admin.shops.coupons.edit', $shop) }}">Редактировать</a>
        </p>
    @endif
    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner">
                <form class="crutch-validate is-alter"
                      action="{{ $shop->id ? route('admin.shops.update', $shop) : route('admin.shops.store') }}" method="post">
                    <div class="row g-gs">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="name">Название</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ $shop->name }}"
                                           placeholder="Крутой магазин" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="slug">Slug</label>
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="slug" name="slug"
                                               value="{{ $shop->slug }}"
                                               placeholder="ЧПУ" required>
                                        <div class="input-group-append">
                                            <button id="slug-generate" class="btn btn-outline-primary" type="button">
                                                <span class="icon ni ni-cpu"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-gs">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="activity">Статус</label>
                                <div class="form-control-wrap">
                                    <select id="activity" class="form-control form-select select2-hidden-accessible"
                                            name="activity" data-placeholder="Выбрать" data-msg="Выберите статус"
                                            required>
                                        @foreach(array_reverse(\App\Models\Shop::statusList(), true) as $key => $value)
                                            <option value="{{ $key }}" @selected($key === $shop->activity)>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="important">Вип-статус</label>
                                <div class="form-control-wrap">
                                    <select id="important" class="form-control form-select select2-hidden-accessible"
                                            name="important" data-placeholder="Выбрать" data-msg="Выберите вип"
                                            required>
                                        @foreach(\App\Models\Shop::importantList() as $key => $value)
                                            <option value="{{ $key }}" @selected($key === $shop->important)>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="founding_year">Год основания</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control date-picker" id="founding_year"
                                            name="founding_year"
                                            value="{{ $shop->founding_year }}"
                                            data-date-format="yyyy" data-date-min-view-mode="2" data-date-max-view-mode="2">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-gs">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="link">Реальная ссылка</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="link" name="link"
                                           value="{{ $shop->link }}"
                                           placeholder="https://example.com" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="pixel">Рекламная ссылка</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="pixel" name="pixel"
                                           value="{{ $shop->pixel }}"
                                           placeholder="https://example.com/partner" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-gs">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="description">Описание</label>
                                <div class="form-control-wrap">
                                    <textarea style="min-height: 120px" class="form-control form-control-sm"
                                              id="description"
                                              name="description"
                                              placeholder="Краткое описание">{{ $shop->description }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="advantage">Преимущества</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="advantage" name="advantage"
                                           value="{{ $shop->advantage }}"
                                           placeholder="Преимущества магазина">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Лого</label>
                                <!--suppress HtmlFormInputWithoutLabel -->
                                <input style="visibility:hidden" id="img" type="text" name="img"
                                       value="{{ $shop->img }}" required
                                       data-msg="Загрузите картинку">
                                <div class="form-control crutch-dropzone dz-clickable">
                                    <div class="dz-message" data-dz-message>
                                        @if($shop->id)
                                            <div id="article-img">
                                                <img src="{{ $shop->img }}" width="150" height="150" alt="{{ $shop->name }}">
                                            </div>
                                        @endif
                                        <div>
                                            <span class="dz-message-text">Перетащите картинку сюда</span>
                                            <span class="dz-message-or">или</span>
                                            <button type="button" class="btn btn-primary">ВЫБРАТЬ</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-gs">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="seo_h1">SEO H1</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="seo_h1" name="seo_h1"
                                            value="{{ $shop->seo_h1 }}"
                                            placeholder="Крутой магазин" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="seo_title">SEO Title</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="seo_title" name="seo_title"
                                            value="{{ $shop->seo_title }}"
                                            placeholder="Крутой магазин" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-gs">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="seo_description">SEO Description</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="seo_description" name="seo_description"
                                            value="{{ $shop->seo_description }}"
                                            placeholder="Крутой магазин" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="cities">Города</label>
                                <div class="form-control-wrap">
                                    <select class="form-select js-select2"
                                            id="cities"
                                            name="cities[]"
                                            multiple="multiple"
                                            data-search="on"
                                            data-placeholder="Выберите города">
                                        @php
                                            $cities_ids = $shop->cities->pluck('id')->toArray();
                                        @endphp
                                        @foreach(\App\Models\City::all() as $city)
                                            <option value="{{ $city->id }}"
                                                    @selected(in_array($city->id, $cities_ids, true))>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-gs">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="seo_h1_reviews">SEO H1 на странице отзывов</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="seo_h1_reviews" name="seo_h1_reviews"
                                            value="{{ $shop->seo_h1_reviews }}"
                                            placeholder="Крутые отзывы магазина" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="seo_title_reviews">SEO Title на странице отзывов</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="seo_title_reviews" name="seo_title_reviews"
                                            value="{{ $shop->seo_title_reviews }}"
                                            placeholder="Крутые отзывы магазина" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-gs">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="seo_description_reviews">SEO Description на странице отзывов</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="seo_description_reviews" name="seo_description_reviews"
                                            value="{{ $shop->seo_description_reviews }}"
                                            placeholder="Крутые отзывы магазина" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-gs">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="rating">Рейтинг</label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control" id="rating" name="rating"
                                           value="{{ $shop->rating ?? 0 }}"
                                           readonly disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="cities_cnt">Количество городов</label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control" id="cities_cnt" name="cities_cnt"
                                           value="{{ $shop->cities_cnt }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="delivery_cost">Цена доставки</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="delivery_cost" name="delivery_cost"
                                           value="{{ $shop->delivery_cost }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="hack_rating">Купленный рейтинг</label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control" id="hack_rating" name="hack_rating"
                                           value="{{ $shop->hack_rating ?? 0 }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="brands_cnt">Количество брендов</label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control" id="brands_cnt" name="brands_cnt"
                                           value="{{ $shop->brands_cnt }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="delivery_time">Время доставки</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="delivery_time" name="delivery_time"
                                           value="{{ $shop->delivery_time }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="position">Позиция</label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control" id="position" name="position"
                                           value="{{ $shop->position ?? 1 }}"
                                           required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="products_cnt">Количество товаров</label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control" id="products_cnt" name="products_cnt"
                                           value="{{ $shop->products_cnt }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="discounts">Скидка</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="discounts" name="discounts"
                                           value="{{ $shop->discounts }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-gs">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="content">Контент</label>
                                <div class="form-control-wrap">
                                    <textarea style="height: 400px"
                                              class="form-control form-control-sm summernote-basic" id="content"
                                              name="content" placeholder="Текст" required>{!! $shop->content !!}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">
                                    {{ $shop->id ? 'Сохранить' : 'Добавить' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="/dashboard/js/summernote.js"></script>
    <script src="/dashboard/js/editors.js"></script>
    <script src="/dashboard/js/slug.js"></script>

    <!--suppress JSUnresolvedFunction -->
    <script>
      $(function() {
        const img = $('#img');

        const options = {
          url: '{{ route('services.upload.shop') }}',
          maxFiles: 1,
          thumbnailWidth: 150,
          thumbnailHeight: 150,
          init: function() {
            this.on('maxfilesexceeded', function(file) {
              this.removeAllFiles();
              this.addFile(file);
            });
            this.on('success', function(file, res) {
              img.val(res.path || '').removeClass('invalid').nextAll('.invalid').hide();
              $('#product-img').remove();
            });
            this.on('removedfile', function() {
              img.val('');
            });
          },
        };
        $('.crutch-dropzone').crutchZone(options);

        $('.form-select').on('select2:select', function() {
          $(this).removeClass('invalid').nextAll('#category_id-error').hide();
        });

        $('#slug-generate').slugGenerate();
      });
    </script>
@endpush
