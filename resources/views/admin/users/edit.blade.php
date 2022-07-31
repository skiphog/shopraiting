<?php

/**
 * @var \App\Models\User $user
 */

?>
@extends('layouts.admin')

@section('title', "Профиль {$user->name}")
@section('description', "Профиль {$user->name}")

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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="name">Имя</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ $user->name }}"
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="email">Email</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email" name="email"
                                           value="{{ $user->email }}"
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="role">Роль</label>
                                <div class="form-control-wrap">
                                    <select id="role" class="form-control form-select select2-hidden-accessible"
                                            name="role" data-placeholder="Выбрать" data-msg="Выберите роль"
                                            required>
                                        @foreach(\App\Models\User::$roles as $key => $value)
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
                                    <textarea style="min-height: 120px" class="form-control form-control-sm"
                                              id="description"
                                              name="description"
                                              placeholder="Краткое описание">{{ $user->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-gs">
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">Сохранить</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection