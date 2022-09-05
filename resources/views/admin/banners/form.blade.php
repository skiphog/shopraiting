<?php

/**
 * @var \App\Models\Banner $banner
 */
?>
@push('style')
    <link rel="stylesheet" href="/dashboard/css/crutch-zone.css">
@endpush

@section('content')
    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Панель</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.banners.index') }}">Баннеры</a></li>
            <li class="breadcrumb-item active">{{ $banner->id ? 'Редактирование' : 'Добавление' }}</li>
        </ul>
    </nav>

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">
                    {{ $banner->id ? $banner->name : 'Добавить Баннер' }}
                </h3>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner">
                <form class="crutch-validate is-alter"
                        action="{{ $banner->id ? route('admin.banners.update', $banner) : route('admin.banners.store') }}"
                        method="post">

                    <div class="row g-gs">

                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="name">Название</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $banner->name }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="link">Ссылка</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="link" name="link"
                                            value="{{ $banner->link }}" required>
                                </div>
                            </div>

                            <div class="row g-gs">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="activity">Статус</label>
                                        <div class="form-control-wrap">
                                            <select id="activity" class="form-control form-select select2-hidden-accessible"
                                                    name="activity" data-placeholder="Выбрать" data-msg="Выберите статус"
                                                    required>
                                                @foreach(array_reverse(\App\Models\Banner::statusList(), true) as $key => $value)
                                                    <option value="{{ $key }}" @selected($key === $banner->activity)>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex h-100 align-items-end justify-between">
                                        @if($banner->id)
                                            <button type="submit" class="btn btn-primary">Сохранить</button>
                                            <button id="banner-destroy" type="button" class="btn btn-outline-danger">Удалить</button>
                                        @else
                                            <button type="submit" class="btn btn-primary">Добавить</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Изображение</label>
                                <!--suppress HtmlFormInputWithoutLabel -->
                                <input style="visibility:hidden" id="path" type="text" name="path"
                                        value="{{ $banner->path }}" required
                                        data-msg="Загрузите картинку">
                                <div class="form-control crutch-dropzone dz-clickable">
                                    <div class="dz-message" data-dz-message>
                                        @if($banner->id)
                                            <div id="article-img">
                                                <img src="{{ $banner->path }}" width="150" height="150" alt="{{ $banner->name }}">
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
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!--suppress JSUnresolvedFunction -->
    <script>
      $(function() {
        const img = $('#path');

        const options = {
          url: '{{ route('services.upload.banner') }}',
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

        @if($banner->id)
            $('#banner-destroy').on('click', function(e) {
          e.preventDefault();

          Swal.fire({
            title: 'Удалить баннер?',
            text: '',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3f54ff',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Да. Удалить!',
            cancelButtonText: 'Отмена',
            showLoaderOnConfirm: true,
            preConfirm: function() {
              return $.post('{{ route('admin.banners.destroy', $banner) }}', {}, null, 'json').then(function(json) {
                location.assign(json.redirect || '/');
              }).catch(function(err) {
                Swal.showValidationMessage(err['responseJSON']['error'] || 'Forbidden!');
              });
            },
            allowOutsideClick: () => !Swal.isLoading(),
          });
        });
        @endif
      });
    </script>

@endpush
