<?php

/**
 * @var \App\Models\User $user
 */

?>
@extends('layouts.admin')

@section('title', "Профиль {$user->name}")
@section('description', "Профиль {$user->name}")

@push('style')
    <link rel="stylesheet" href="/dashboard/css/summernote.css">
    <link rel="stylesheet" href="/dashboard/css/codemirror.css">
    <link rel="stylesheet" href="/dashboard/css/monokai.css">
@endpush

@section('content')
    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Панель</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Пользователи</a></li>
            <li class="breadcrumb-item active">Управление</li>
        </ul>
    </nav>

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">{{ $user->name }}</h3>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner">
                <form class="crutch-validate is-alter"
                      action="{{ route('admin.users.update', $user) }}"
                      method="post">
                    <div class="row g-gs">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="name">Имя</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="email">Email</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="slug">Slug</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="slug" name="slug" value="{{ $user->slug }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="role">Роль</label>
                                <div class="form-control-wrap">
                                    <select id="role" class="form-control form-select select2-hidden-accessible"
                                            name="role" data-placeholder="Выбрать" data-msg="Выберите роль"
                                            required>
                                        @foreach(\App\Models\User::rolesList() as $key => $value)
                                            <option value="{{ $key }}" @selected($key === $user->role)>
                                                {{ $value }}
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
                                <label class="form-label" for="description">Описание</label>
                                <div class="form-control-wrap">
                                    <textarea style="height: 460px" class="form-control form-control-sm summernote-basic"
                                              id="description"
                                              name="description"
                                              placeholder="Краткое описание">{{ $user->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-gs">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary">Сохранить</button>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-lg btn-dim btn-primary"
                                            type="button"
                                            data-toggle="modal" data-target="#edit-profile">
                                        <em class="icon ni ni-exchange"></em>
                                        <span>Сменить пароль</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade" tabindex="-1" role="dialog" id="edit-profile">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h5 class="modal-title">Сменить пароль</h5>
                    <form action="{{ route('admin.users.password', $user) }}" class="mt-4 crutch-validate is-alter">
                        <div class="row g-gs">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label class="form-label" for="password">Пароль</label>
                                    </div>
                                    <div class="form-control-wrap">
                                        <a href="#" tabindex="-1"
                                                class="form-icon form-icon-right passcode-switch lg"
                                                data-target="password">
                                            <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                            <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                        </a>
                                        <input type="password" class="form-control form-control-lg"
                                                id="password" name="password" placeholder="Ваш пароль"
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
    <script src="/dashboard/js/codemirror.js"></script>
    <script src="/dashboard/js/xml.js"></script>
    <script src="/dashboard/js/formatting.js"></script>
    <script src="/dashboard/js/summernote.js"></script>
    <script src="/dashboard/js/editors.js?v=100"></script>
@endpush