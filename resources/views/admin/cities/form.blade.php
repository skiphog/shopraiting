<?php

/**
 * @var \App\Models\City     $city
 * @var \App\Models\User[]   $users
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
                                            placeholder="Города в Зимбабве" required>
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

                        <div class="col-md-4">
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
@endpush
