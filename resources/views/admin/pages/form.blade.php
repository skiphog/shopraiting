<?php

/**
 * @var \App\Models\Page   $page
 * @var \App\Models\User[] $users
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
            <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Страницы</a></li>
            <li class="breadcrumb-item active">{{ $page->id ? 'Редактирование' : 'Добавление' }}</li>
        </ul>
    </nav>

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">
                    {{ $page->id ? $page->name : 'Добавить страницу' }}
                </h3>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner">
                <form class="crutch-validate is-alter"
                        action="{{ $page->id ? route('admin.pages.update', $page) : route('admin.pages.store') }}"
                        method="post">
                    <div class="row g-gs">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="name">Название</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $page->name }}"
                                            placeholder="Секс шопы в Зимбабве" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="slug">Slug</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="slug" name="slug"
                                            value="{{ $page->slug }}"
                                            placeholder="slug" required
                                            @disabled(1 === (int)$page->id)
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
                                            value="{{ $page->seo_h1 }}" required>
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
                                            <option value="{{ $user->id }}" @selected($user->id === $page->user_id)>
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
                                            value="{{ $page->seo_title }}"
                                            placeholder="Секс шопы в Зимбабве" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="seo_description">SEO Description</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="seo_description" name="seo_description"
                                            value="{{ $page->seo_description }}"
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
                                            data-search="on"
                                            data-placeholder="Выберите магазины">
                                        @php
                                            $shop_ids = $page->shops->pluck('id')->toArray();
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
                                            placeholder="Текст">{{ $page->before_content }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="content">Основной контент</label>
                                <div class="form-control-wrap">
                                    <textarea style="height: 400px" class="form-control form-control-sm summernote-basic"
                                            id="content" name="content" placeholder="Текст статьи"
                                            required>{!! $page->content !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-gs">
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">
                                    {{ $page->id ? 'Сохранить': 'Добавить' }}
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
