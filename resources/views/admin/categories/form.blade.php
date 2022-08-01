<?php

/**
 * @var \App\Models\Category $category
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
            <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Категории</a></li>
            <li class="breadcrumb-item active">{{ $category->id ? 'Редактирование' : 'Добавление' }}</li>
        </ul>
    </nav>

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">
                    {{ $category->id ? $category->name : 'Добавить категорию' }}
                </h3>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner">
                <form class="crutch-validate is-alter"
                        action="{{ $category->id ? route('admin.categories.update', $category) : route('admin.categories.store') }}"
                        method="post">
                    <div class="row g-gs">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="name">Название</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $category->name }}"
                                            placeholder="Секс шопы в Зимбабве" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="slug">Slug</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="slug" name="slug"
                                            value="{{ $category->slug }}"
                                            placeholder="slug" required
                                            @disabled(1 === (int)$category->id)
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-gs">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-label" for="seo_h1">SEO H1</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="seo_h1" name="seo_h1"
                                            value="{{ $category->seo_h1 }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="user_id">Автор</label>
                                <div class="form-control-wrap">
                                    <!--suppress HtmlFormInputWithoutLabel -->
                                    <select id="user_id" class="form-control form-select select2-hidden-accessible"
                                            name="user_id" data-placeholder="Выбрать" data-msg="Выберите пользователя"
                                            required>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" @selected($user->id === $category->user_id)>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-gs">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="seo_title">SEO Title</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="seo_title" name="seo_title"
                                            value="{{ $category->seo_title }}"
                                            placeholder="Секс шопы в Зимбабве" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="seo_description">SEO Description</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="seo_description" name="seo_description"
                                            value="{{ $category->seo_description }}"
                                            placeholder="slug" required>
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
                                            data-placeholder="Выберите магазины">
                                        @php
                                            $shop_ids = $category->shops->pluck('id')->toArray();
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
                                            placeholder="Текст">{{ $category->before_content }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="content">Основной контент</label>
                                <div class="form-control-wrap">
                                    <textarea style="height: 400px" class="form-control form-control-sm summernote-basic"
                                            id="content" name="content" placeholder="Текст статьи"
                                            required>{!! $category->content !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-gs">
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">
                                    {{ $category->id ? 'Сохранить': 'Добавить' }}
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