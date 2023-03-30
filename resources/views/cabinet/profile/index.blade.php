<?php

/**
 * @var \App\Models\User $user
 */

?>
@extends('layouts.cabinet')

@section('title', 'Профиль')
@section('description', 'Профиль')

@push('style')
    <style>
      .avatar-img{display:block;width:300px;margin:0 auto 20px;box-shadow:0 1px 5px #aaa;}
      .input-hidden{clip:rect(0 0 0 0);border:0;-webkit-clip-path: inset(100%);clip-path:inset(100%);height:1px;margin:-1px;overflow:hidden;padding:0;position:absolute;white-space:nowrap;width:1px}
      .btn-pulse{position:relative}
      .btn-pulse::before{content:'';position:absolute;left:50%;top:50%;transform:translate(-50%, -50%);border:2px solid #16e1ae;width:100%;border-radius:5px;height:100%;opacity:.9;animation:wave-stroke 1s infinite ease-in-out}
      @keyframes wave-stroke{100%{width:200%;height:200%;border-color:transparent;opacity:0}}
    </style>
    <link rel="stylesheet" href="/dashboard/css/summernote.css">
    <link rel="stylesheet" href="/dashboard/css/codemirror.css">
    <link rel="stylesheet" href="/dashboard/css/monokai.css">
@endpush

@section('content')
    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('cabinet.index') }}">Кабинет</a></li>
            <li class="breadcrumb-item active">Профиль</li>
        </ul>
    </nav>

    <div class="nk-block mt-3">
        <div class="card card-bordered">
            <div class="card-aside-wrap">
                <div class="card-inner card-inner-lg">
                    @includeUnless($user->hasVerifiedEmail(), 'cabinet.partials.warning')
                    <div class="nk-block-head nk-block-head-lg">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content"><h4 class="nk-block-title">Личная информация</h4>
                                <div class="nk-block-des">
                                    <p>Основная информация, такая как ваше имя и адрес, которую вы используете на платформе {{ config('app.name', 'sexshoprating') }}.</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content align-self-start d-lg-none">
                                <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block">

                        <div class="nk-data data-list">
                            <div class="data-head"><h6 class="overline-title">Основные данные</h6></div>
                            <div class="data-item" data-toggle="modal" data-target="#edit-profile">
                                <div class="data-col">
                                    <span class="data-label">Имя</span>
                                    <div class="data-value">
                                        <span>{{ $user->name }}</span>
                                        <br>
                                        <span>{{ $user->slug }}</span>
                                    </div>
                                </div>
                                <div class="data-col data-col-end">
                                    <span class="data-more"><em class="icon ni ni-forward-ios"></em></span>
                                </div>
                            </div>
                            <div class="data-item" data-toggle="modal" data-target="#edit-profile">
                                <div class="data-col">
                                    <div class="data-value">{!! $user->description ?: 'Нет описания' !!}</div>
                                </div>
                                <div class="data-col data-col-end">
                                    <span class="data-more"><em class="icon ni ni-forward-ios"></em></span>
                                </div>
                            </div>
                            <div class="data-item" data-toggle="modal" data-target="#change-password">
                                <div class="data-col">
                                    <span class="data-label">Пароль</span>
                                    <span class="data-value">*********</span>
                                </div>
                                <div class="data-col data-col-end">
                                    <span class="data-more"><em class="icon ni ni-forward-ios"></em></span>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">Email</span>
                                    <span class="data-value">{{ $user->email }}</span>
                                </div>
                                <div class="data-col data-col-end">
                                    <span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">Роль</span>
                                    <span class="data-value">{{ $user->role_name }}</span>
                                </div>
                                <div class="data-col data-col-end">
                                    <span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">Дата регистрации</span>
                                    <span class="data-value">{{ $user->created_at->format('d.m.Y \в H:i') }}</span>
                                </div>
                                <div class="data-col data-col-end">
                                    <span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                    <div class="card-inner-group" data-simplebar>
                        <div class="card-inner">
                            <div class="user-card">
                                <div class="user-avatar bg-primary"><img src="{{ $user->avatar }}" width="40px" height="40px" alt=""><span></span></div>
                                <div class="user-info">
                                    <span class="lead-text">{{ $user->name }}</span>
                                    <span class="sub-text">{{ $user->email }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="card-inner">
                            <div class="upload-avatar-img">
                                <img id="avatar-img" class="avatar-img" src="{{ $user->avatar }}" width="300" height="" alt="">
                                <div class="settings-avatar d-flex justify-around mb-4 hidden" id="settings-avatar">
                                    <button class="btn btn-lg btn-success btn-pulse" id="save-avatar">Сохранить</button>
                                    <button class="btn btn-lg btn-dim btn-danger" id="cancel-avatar">Отмена</button>
                                </div>
                                <div class="text-center">
                                    <button id="avatar-b-upload" class="btn btn-round btn-xl btn-outline-light" type="button">
                                        <span>Загрузить аватар</span>
                                    </button>
                                </div>
                                <input id="avatar-file" type="file" class="input-hidden" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade" tabindex="-1" role="dialog" id="edit-profile">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h5 class="modal-title">Редактировать профиль</h5>
                    <form action="{{ route('cabinet.profile.update') }}" class="mt-4 crutch-validate is-alter">
                        <div class="row g-gs">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="name">Имя</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="slug">Slug</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="slug" name="slug" value="{{ $user->slug }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="description">Описание</label>
                                    <div class="form-control-wrap">
                                    <textarea style="height: 200px" class="form-control form-control-sm summernote-basic"
                                            id="description"
                                            name="description"
                                            placeholder="Краткое описание">{{ $user->description }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li><button type="submit" class="btn btn-primary">Сохранить</button></li>
                                    <li><a href="#" class="link link-light" data-dismiss="modal">Отмена</a></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="change-password">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h5 class="modal-title">Сменить пароль</h5>
                    <form action="{{ route('cabinet.profile.password') }}" class="mt-4 crutch-validate is-alter">
                        <div class="row g-gs">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label class="form-label" for="password">Новый пароль</label>
                                    </div>
                                    <div class="form-control-wrap">
                                        <a href="#" tabindex="-1"
                                                class="form-icon form-icon-right passcode-switch lg"
                                                data-target="password">
                                            <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                            <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                        </a>
                                        <input type="password" class="form-control form-control-lg"
                                                id="password" name="password" placeholder="Пароль"
                                                autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="password_confirmation">Подтверждение пароля</label>
                                    <div class="form-control-wrap">
                                        <a href="#" tabindex="-1"
                                                class="form-icon form-icon-right lg passcode-switch"
                                                data-target="password_confirmation">
                                            <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                            <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                        </a>
                                        <input type="password"
                                                class="form-control form-control-lg"
                                                id="password_confirmation"
                                                name="password_confirmation"
                                                placeholder="Подтверждение пароля" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li><button type="submit" class="btn btn-primary">Сохранить</button></li>
                                    <li><a href="#" class="link link-light" data-dismiss="modal">Отмена</a></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
      (function ($) {
        const
          b_upload = $('#avatar-b-upload'),
          a_file = $('#avatar-file'),
          a_img = $('#avatar-img'),
          img_old = a_img.attr('src'),
          settings_avatar = $('#settings-avatar'),
          save_button = $('#save-avatar'),
          alert_avatar = $('#alert-avatar');

        let
          send = true,
          image = null;

        b_upload.on('click', function () {
          a_file.trigger('click');
        });
        $('#cancel-avatar').on('click', function () {
          image = null;
          a_img.attr('src', img_old);
          settings_avatar.addClass('hidden');
        });
        a_file.on('change', function (e) {
          if (!e.target.files.length) {
            return;
          }

          const file = e.target.files[0];

          if (file.type.match('image.*') === null || !/\.(jpe?g|png|gif)$/i.test(file.name)) {
            alert(`${file.name} не является изображением`);
            return a_file.val(null);
          }

          image = file;
          a_file.val(null);

          const reader = new FileReader();

          reader.addEventListener('loadstart', () => {
            b_upload.addClass('busy');
          });

          reader.addEventListener('load', () => {
            a_img.attr('src', reader.result);
          });

          reader.addEventListener('loadend', () => {
            b_upload.removeClass('busy');
            alert_avatar.html('').addClass('hidden');
            settings_avatar.removeClass('hidden');
          });

          reader.readAsDataURL(image);
        });
        save_button.on('click', function () {
          if (!send && null === image) {
            return;
          }

          const data = new FormData();
          data.append('file', image);

          $.ajax({
            url: '{{ route('cabinet.profile.avatar') }}',
            type: 'post',
            processData: false,
            contentType: false,
            dataType: 'json',
            data: data,
            beforeSend () {
              send = false;
              save_button.addClass('busy');
            },
            complete () {
              send = true;
              save_button.removeClass('busy');
            },
            error (jqXHR) {
              if (!('status' in jqXHR) || jqXHR['status'] !== 422) {
                return alert('Forbidden!');
              }

              const data = JSON.parse(jqXHR['responseText']);

              image = null;
              a_img.attr('src', img_old);
              settings_avatar.addClass('hidden');

              alert_avatar
                .removeClass('hidden')
                .html(data['errors']['text']);
            },
            success (json) {
              if (!('result' in json) || json['result'] !== true) {
                return alert('Ошибка при добавлении аватарки. Обновите страницу.');
              }

              window.location.replace('{{ route('cabinet.profile.index') }}');
            }
          });
        });

      })(jQuery);
    </script>
    <script src="/dashboard/js/codemirror.js"></script>
    <script src="/dashboard/js/xml.js"></script>
    <script src="/dashboard/js/formatting.js"></script>
    <script src="/dashboard/js/summernote.js"></script>
    <script src="/dashboard/js/editors.js?v=100"></script>
@endpush
