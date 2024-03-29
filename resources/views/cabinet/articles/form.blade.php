<?php

/**
 * @var User    $user
 * @var Article $article
 */

use App\Models\User;
use App\Models\Article;

?>
@push('style')
<link rel="stylesheet" href="/dashboard/css/summernote.css">
<link rel="stylesheet" href="/dashboard/css/crutch-zone.css">
<link rel="stylesheet" href="/dashboard/css/crutch-summernote.css">
@endpush

@section('content')
    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('cabinet.index') }}">Панель</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cabinet.articles.index') }}">Статьи</a></li>
            <li class="breadcrumb-item active">{{ $article->id ? 'Редактирование' : 'Добавление' }}</li>
        </ul>
    </nav>

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">
                    {{ $article->id ? $article->name : 'Добавить статью' }}
                </h3>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner">
                <form class="crutch-validate is-alter"
                      action="{{ $article->id ? route('cabinet.articles.update', $article->id) : route('cabinet.articles.create') }}"
                      method="post">
                    <div class="row g-gs">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="form-label" for="name">Заголовок</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ $article->name }}"
                                           placeholder="Крутая статья" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-5">
                            <div class="form-group">
                                <label class="form-label" for="slug">Slug</label>
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="slug" name="slug"
                                               value="{{ $article->slug }}"
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
                                        @foreach(array_reverse(Article::statusList(), true) as $key => $value)
                                            <option value="{{ $key }}" @selected($key === $article->activity)>
                                                {{ $value }}
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
                                <label class="form-label" for="intro">Интро</label>
                                <div class="form-control-wrap">
                                    <textarea style="min-height: 120px" class="form-control form-control-sm"
                                              id="intro"
                                              name="intro"
                                              placeholder="Краткое описание">{{ $article->intro }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="user_id">Автор статьи</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="user_id"
                                            value="{{ $user->name }}" disabled readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Картинка статьи</label>
                                <!--suppress HtmlFormInputWithoutLabel -->
                                <input style="visibility:hidden" id="img" type="text" name="img"
                                       value="{{ $article->img }}" required data-msg="Загрузите картинку">
                                <div class="form-control crutch-dropzone dz-clickable">
                                    <div class="dz-message" data-dz-message>
                                        @if($article->id)
                                            <div id="article-img">
                                                <img src="{{ $article->img }}" width="150" height="150" alt="{{ $article->name }}">
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
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="before_content">Вступление</label>
                                <div class="form-control-wrap">
                                    <textarea style="height: 200px" class="form-control form-control-sm summernote-basic"
                                              id="before_content" name="before_content" placeholder="Текст статьи"
                                              data-textarea-height="200"
                                              required>{!! $article->before_content !!}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="content">Основной контент</label>
                                <div class="form-control-wrap">
                                    <textarea style="height: 400px" class="form-control form-control-sm summernote-basic"
                                              id="content" name="content" placeholder="Текст статьи"
                                              required>{!! $article->content !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-gs">
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">
                                    {{ $article->id ? 'Сохранить': 'Добавить' }}
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
  $(function () {
    const img = $('#img');

    const options = {
      url: '{{ route('services.upload.base') }}',
      maxFiles: 1,
      thumbnailWidth: 150,
      thumbnailHeight: 150,
      init: function () {
        this.on('maxfilesexceeded', function (file) {
          this.removeAllFiles();
          this.addFile(file);
        });
        this.on('success', function (file, res) {
          img.val(res.path || '').removeClass('invalid').nextAll('.invalid').hide();
          $('#article-img').remove();
        });
        this.on('removedfile', function () {
          img.val('');
        });
      },
    };
    $('.crutch-dropzone').crutchZone(options);

    $('.form-select').on('select2:select', function () {
      $(this).removeClass('invalid').nextAll('#rubric_id-error').hide();
    });

    $('#slug-generate').slugGenerate();
  });
</script>
@endpush
