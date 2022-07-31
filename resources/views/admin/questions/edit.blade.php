<?php

/**
 * @var \App\Models\Question $question
 */

?>
@extends('layouts.admin')

@section('title', 'Вопрос: ' . str($question->message)->limit(50))
@section('description', 'Вопрос: ' . str($question->message)->limit(50))

@section('content')
    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Панель</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.questions.index') }}">Вопросы</a></li>
            <li class="breadcrumb-item active">Управление</li>
        </ul>
    </nav>

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Вопрос #{{ $question->id }}</h3>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-xxl-9 col-lg-8">
                <div class="card card-bordered">
                    <div class="card-inner">
                        <div class="fw-bold text-secondary">Инфо</div>
                        <div>
                            {{ $question->email }}
                            &mdash;
                            {{ $question->name }}
                            ({{ $question->created_at->format('d.m.Y') }} |
                            <span class="small">{{ $question->created_at->diffForHumans() }}</span>)
                        </div>
                        <div class="fw-bold text-secondary">Сообщение</div>
                        <div>{{ $question->message }}</div>
                    </div>
                </div>

                <form class="card card-bordered crutch-validate is-alter"
                        action="{{ route('admin.questions.update', $question) }}">
                    <div class="card-inner">
                        <div class="form-group">
                            <label class="form-label" for="answer">Ответ</label>
                            <div class="form-control-wrap">
                                    <textarea style="min-height: 120px" class="form-control form-control-sm"
                                            id="answer"
                                            name="answer"
                                            placeholder="Ответ на комментарий">{{ $question->answer }}</textarea>
                            </div>
                        </div>
                        <div class="row g-gs">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="rubric_id">Статус</label>
                                    <div class="form-control-wrap" id="activity">
                                        <!--suppress HtmlFormInputWithoutLabel -->
                                        <select class="form-control form-select select2-hidden-accessible"
                                                name="activity" data-placeholder="Выбрать" required
                                                data-msg="Выберите Статус">
                                            <option label="empty" value=""></option>
                                            @foreach(\App\Models\Question::statusList() as $key => $status)
                                                <option value="{{ $key }}" @selected($key === $question->activity)>
                                                    {{ $status }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 align-self-end">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <form id="comment-destroy" class="card card-bordered"
                        action="{{ route('admin.questions.destroy', $question) }}" method="post">
                    <div class="card-inner">
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-danger">Удалить вопрос</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
      (function() {
        $('#comment-destroy').on('submit', function(e) {
          e.preventDefault();

          Swal.fire({
            title: 'Удалить вопрос?',
            text: '',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3f54ff',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Да. Удалить!',
            cancelButtonText: 'Отмена',
            showLoaderOnConfirm: true,
            preConfirm: function() {
              return $.post('{{ route('admin.questions.destroy', $question) }}', {}, null, 'json').then(function(json) {
                location.assign(json.redirect || '/');
              }).catch(function(err) {
                Swal.showValidationMessage(err['responseJSON']['error'] || 'Forbidden!');
              });
            },
            allowOutsideClick: () => !Swal.isLoading(),
          });
        });

      })();
    </script>
@endpush
