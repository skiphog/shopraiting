<?php

/**
 * @var \App\Models\City $city
 */

?>

@push('style')
    <link rel="stylesheet" href="/dashboard/css/summernote.css">
    <link rel="stylesheet" href="/dashboard/css/crutch-summernote.css">
@endpush

@section('content')
    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Панель</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.cities.index') }}">Города</a></li>
            <li class="breadcrumb-item active">{{ $city->id ? 'Редактирование' : 'Добавление' }}</li>
        </ul>
    </nav>

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">
                    {{ $city->id ? $city->name : 'Добавить город' }}
                </h3>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner">
                <form class="crutch-validate is-alter"
                        action="{{ $city->id ? route('admin.cities.update', $city) : route('admin.cities.store') }}"
                        method="post">
                    <div class="row g-gs">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="name">Название</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $city->name }}"
                                            placeholder="Название города" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="slug">Slug</label>
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="slug" name="slug"
                                                value="{{ $city->slug }}"
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

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="postcode">Почтовый индекс</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="postcode" name="postcode"
                                            value="{{ $city->postcode }}"
                                            placeholder="XXXYYY или XXXYYY-XXXYYY"
                                            maxlength="13">
                                </div>
                        </div>
                    </div>
                    </div>

                    <div class="row g-gs">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="seo_h1">SEO H1</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="seo_h1" name="seo_h1"
                                            value="{{ $city->seo_h1 }}" placeholder="SEO H1" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="seo_title">SEO Title</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="seo_title" name="seo_title"
                                            value="{{ $city->seo_title }}"
                                            placeholder="SEO название" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="seo_description">SEO Description</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="seo_description" name="seo_description"
                                            value="{{ $city->seo_description }}"
                                            placeholder="SEO описание" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-gs">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="shops">Магазины</label>
                                <div class="form-control-wrap">
                                    <select class="form-select js-select2"
                                            id="shops"
                                            name="shops[]"
                                            multiple="multiple"
                                            data-search="on"
                                            data-placeholder="Выберите магазины">
                                        @php
                                            $shop_ids = $city->shops->pluck('id')->toArray();
                                        @endphp
                                        @foreach(\App\Models\Shop::getAllWithCache() as $shop)
                                            <option value="{{ $shop->id }}"
                                                    @selected(in_array($shop->id, $shop_ids, true))>
                                                {{ $shop->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="before_content">Вступление</label>
                                <div class="form-control-wrap">
                                    <textarea style="height: 150px" class="form-control form-control-sm"
                                            id="before_content" name="before_content"
                                            placeholder="Текст">{{ $city->before_content }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="content">Основной контент</label>
                                <div class="form-control-wrap">
                                    <textarea style="height: 400px" class="form-control form-control-sm summernote-basic"
                                            id="content" name="content" placeholder="Текст описания"
                                            required>{!! $city->content !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-gs">
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">
                                    {{ $city->id ? 'Сохранить': 'Добавить' }}
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
    <script>$('#slug-generate').slugGenerate();</script>
@endpush
