<?php

/**
 * @var \App\Models\Brand $brand
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
            <li class="breadcrumb-item"><a href="{{ route('admin.brands.index') }}">Бренды</a></li>
            <li class="breadcrumb-item active">{{ $brand->id ? 'Редактирование' : 'Добавление' }}</li>
        </ul>
    </nav>

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">
                    {{ $brand->id ? $brand->name : 'Добавить бренд' }}
                </h3>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner">
                <form class="crutch-validate is-alter"
                      action="{{ $brand->id ? route('admin.brands.update', $brand) : route('admin.brands.store') }}"
                      method="post">
                    <div class="row g-gs">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="form-label" for="name">Название</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $brand->name }}"
                                            placeholder="Крутой бренд" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-5">
                            <div class="form-group">
                                <label class="form-label" for="slug">Slug</label>
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="slug" name="slug"
                                                value="{{ $brand->slug }}"
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
                        <div class="col-md-3 col-lg-2">
                            <div class="form-group">
                                <label class="form-label" for="activity">Статус</label>
                                <div class="form-control-wrap">
                                    <select id="activity" class="form-control form-select select2-hidden-accessible"
                                            name="activity" data-placeholder="Выбрать" data-msg="Выберите статус"
                                            required>
                                        @foreach(array_reverse(\App\Models\Brand::statusList(), true) as $key => $value)
                                            <option value="{{ $key }}" @selected($key === $brand->activity)>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-gs">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="form-label" for="link">Реальная ссылка</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="link" name="link"
                                            value="{{ $brand->link }}"
                                            placeholder="https://example.com" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-5">
                            <div class="form-group">
                                <label class="form-label" for="pixel">Рекламная ссылка</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="pixel" name="pixel"
                                            value="{{ $brand->pixel }}"
                                            placeholder="https://example.com/partner">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-2">
                            <div class="form-group">
                                <label class="form-label" for="country">Страна</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="country" name="country"
                                            value="{{ $brand->country }}"
                                            placeholder="Россия" required>
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
                                            placeholder="Краткое описание" required>{{ $brand->description }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="rooster"></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="rooster" readonly disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Лого</label>
                                <!--suppress HtmlFormInputWithoutLabel -->
                                <input style="visibility:hidden" id="img" type="text" name="img"
                                        value="{{ $brand->img }}" required
                                        data-msg="Загрузите картинку">
                                <div class="form-control crutch-dropzone dz-clickable">
                                    <div class="dz-message" data-dz-message>
                                        @if($brand->id)
                                            <div id="article-img">
                                                <img src="{{ $brand->img }}" width="150" height="150" alt="{{ $brand->name }}">
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="rating">Рейтинг</label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control" id="rating" name="rating"
                                            value="{{ $brand->rating ?? 0 }}"
                                            readonly disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="hack_rating">Купленный рейтинг</label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control" id="hack_rating" name="hack_rating"
                                            value="{{ $brand->hack_rating ?? 0 }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="position">Позиция</label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control" id="position" name="position"
                                            value="{{ $brand->position ?? 1 }}"
                                            required>
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
                                            value="{{ $brand->seo_h1 }}"
                                            placeholder="Крутой бренд" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="seo_title">SEO Title</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="seo_title" name="seo_title"
                                            value="{{ $brand->seo_title }}"
                                            placeholder="Крутой бренд" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-gs">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="seo_description">SEO Description</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="seo_description" name="seo_description"
                                            value="{{ $brand->seo_description }}"
                                            placeholder="Крутой бренд" required>
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
                                            name="content" placeholder="Текст" required>{!! $brand->content !!}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">
                                    {{ $brand->id ? 'Сохранить' : 'Добавить' }}
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
          url: '{{ route('services.upload.base') }}',
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
