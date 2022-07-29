<?php

/**
 * @var \App\Models\Review $review
 */

?>
@extends('layouts.admin')

@section('title', "Отзыв: «{$review->shop->name}»")
@section('description', "Отзыв: «{$review->shop->name}»")

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Отзыв о «{{ $review->shop->name }}»</h3>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-xxl-3 col-lg-4">
                <div class="card card-bordered product-card">
                    <div class="product-thumb">
                        <a class="d-flex justify-center mt-3" href="{{ route('admin.shops.edit', $review->shop) }}">
                            <img class="img-thumbnail" src="{{ $review->shop->img }}" width="170" alt="">
                        </a>
                    </div>
                    <div class="card-inner text-center">
                        <h5 class="product-title">
                            <a href="{{ route('admin.shops.edit', $review->shop) }}">
                                {{ $review->shop->name }}
                            </a>
                        </h5>

                        <div class="product-rating justify-content-center">
                            <ul class="rating">
                                @foreach($stars = range(1,10) as $star)
                                    @if($review->shop->rating_value >= $star)
                                        <li><em class="icon ni ni-star-fill"></em></li>
                                    @elseif($review->shop->rating_value >= ($star - 0.5))
                                        <li><em class="icon ni ni-star-half-fill"></em></li>
                                    @elseif($review->shop->rating_value >= ($star - 0.9))
                                        <li><em class="icon ni ni-star-half"></em></li>
                                    @else
                                        <li><em class="icon ni ni-star text-soft"></em></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="amount">
                            <h5>
                                @if($review->shop->rating !== $review->shop->rating_value)
                                    <span class="text-gray">
                                        {{ number_format($review->shop->rating, 1, ',', ' ') }}
                                    </span>
                                    <>
                                @endif
                                <span class="text-azure">{{ $review->shop->rating_value_format }}</span>
                            </h5>
                            <div>
                                ({{ $review->shop->reviews_count }}
                                {{ trans_choice('dic.review', $review->shop->reviews_count) }})
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-9 col-lg-8">
                <div class="card card-bordered">
                    <div class="card-inner">
                        <div class="fw-bold text-secondary">Инфо</div>
                        <div>
                            {{ $review->author_email }}
                            &mdash;
                            {{ $review->author_name }}
                           ({{ $review->created_at->format('d.m.Y') }} |
                            <span class="small">{{ $review->created_at->diffForHumans() }}</span>)
                        </div>
                        <div class="fw-bold text-secondary">Оценка</div>
                        <div class="product-rating">
                            <ul class="rating">
                                @foreach($stars as $star)
                                    @if($review->rating >= $star)
                                        <li><em class="icon ni ni-star-fill"></em></li>
                                    @elseif($review->rating >= ($star - 0.5))
                                        <li><em class="icon ni ni-star-half-fill"></em></li>
                                    @elseif($review->rating >= ($star - 0.9))
                                        <li><em class="icon ni ni-star-half"></em></li>
                                    @else
                                        <li><em class="icon ni ni-star text-soft"></em></li>
                                    @endif
                                @endforeach
                            </ul>
                            <div class="amount font-weight-bold {{ $review->isNegative() ? 'text-danger' : 'text-success' }}">
                                ({{ $review->rating_format }})
                                {{ $review->isNegative() ? 'Негативный' : 'Позитивный' }}
                            </div>
                        </div>
                        <div class="fw-bold text-secondary">Сообщение</div>
                        <div>{{ $review->content }}</div>
                    </div>
                </div>

                <form class="card card-bordered crutch-validate is-alter"
                      action="{{ route('admin.reviews.update', $review) }}">
                    <div class="card-inner">
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
                                            @foreach(\App\Models\Review::statusList() as $key => $status)
                                                <option value="{{ $key }}" @selected($key === $review->activity)>
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

                <form id="review-destroy" class="card card-bordered"
                      action="{{ route('admin.reviews.destroy', $review) }}" method="post">
                    <div class="card-inner">
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-danger">Удалить отзыв</button>
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
        $('#review-destroy').on('submit', function(e) {
          e.preventDefault();

          Swal.fire({
            title: 'Удалить отзыв?',
            text: '',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3f54ff',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Да. Удалить!',
            cancelButtonText: 'Отмена',
            showLoaderOnConfirm: true,
            preConfirm: function() {
              return $.post('{{ route('admin.reviews.destroy', $review) }}', {}, null, 'json').then(function(json) {
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
