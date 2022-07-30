<?php

/**
 * @var \App\Models\Comment $comment
 */

?>
@extends('layouts.admin')

@section('title', "Комментарий к: «{$comment->post['name']}»")
@section('description', "Комментарий к: «{$comment->post['name']}»")

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Комментарий к «{{ $comment->post['name'] }}»</h3>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-xxl-3 col-lg-4">
                <div class="card card-bordered product-card">
                    <div class="product-thumb">
                        <a class="d-flex justify-center mt-3" href="{{ route('admin.articles.edit', $comment->post) }}">
                            <img class="img-thumbnail" src="{{ $comment->post['img'] }}" width="170" alt="">
                        </a>
                    </div>
                    <div class="card-inner text-center">
                        <h5 class="product-title">
                            <a href="{{ route('admin.articles.edit', $comment->post) }}">
                                {{ $comment->post['name'] }}
                            </a>
                        </h5>
                        <div>{{ $comment->post['intro'] }}</div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-9 col-lg-8">
                <div class="card card-bordered">
                    <div class="card-inner">
                        <div class="fw-bold text-secondary">Инфо</div>
                        <div>
                            {{ $comment->email }}
                            &mdash;
                            {{ $comment->name }}
                            ({{ $comment->created_at->format('d.m.Y') }} |
                            <span class="small">{{ $comment->created_at->diffForHumans() }}</span>)
                        </div>
                        <div class="fw-bold text-secondary">Сообщение</div>
                        <div>{{ $comment->message }}</div>
                    </div>
                </div>

                <form class="card card-bordered crutch-validate is-alter"
                        action="{{ route('admin.comments.update', $comment) }}">
                    <div class="card-inner">
                        <div class="form-group">
                            <label class="form-label" for="answer">Ответ</label>
                            <div class="form-control-wrap">
                                    <textarea style="min-height: 120px" class="form-control form-control-sm"
                                            id="answer"
                                            name="answer"
                                            placeholder="Ответ на комментарий">{{ $comment->answer }}</textarea>
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
                                            @foreach(\App\Models\Comment::statusList() as $key => $status)
                                                <option value="{{ $key }}" @selected($key === $comment->activity)>
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
                        action="{{ route('admin.comments.destroy', $comment) }}" method="post">
                    <div class="card-inner">
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-danger">Удалить комментарий</button>
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
            title: 'Удалить комментарий?',
            text: '',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3f54ff',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Да. Удалить!',
            cancelButtonText: 'Отмена',
            showLoaderOnConfirm: true,
            preConfirm: function() {
              return $.post('{{ route('admin.comments.destroy', $comment) }}', {}, null, 'json').then(function(json) {
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
