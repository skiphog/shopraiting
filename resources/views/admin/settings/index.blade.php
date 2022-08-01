<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

?>
@extends('layouts.admin')

@section('title', 'Настройки')
@section('description', 'Настройки')

@section('content')
    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Панель</a></li>
            <li class="breadcrumb-item active">Настройки</li>
        </ul>
    </nav>

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Все настройки</h3>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner">
                <div class="row g-gs">
                    <div class="col-md-5 col-lg-4">
                        <div class="card card-bordered">
                            <div class="card-body">
                                <h5 class="card-title"><em class="icon ni ni-network"></em> <span>SiteMap</span></h5>
                                <p class="card-text">Модуль для генерации карты сайта</p>
                                <button class="btn btn-lg btn-primary" id="sitemap" type="button">
                                    <em class="icon ni ni-reload"></em>
                                    <span>Сгенерировать</span>
                                </button>
                            </div>
                            <div class="card-footer border-top" id="sitemap-result">
                                @if(Storage::exists('sitemap.xml'))
                                    <div>
                                        <span class="">Создан &mdash;</span>
                                        {{ ($carbon = Carbon::createFromTimestamp(Storage::lastModified('sitemap.xml')))->format('d.m.Y \в H:i') }}
                                        | {{ $carbon->diffForHumans() }}
                                    </div>
                                @else
                                    <span class="fw-bold text-danger">SiteMap не найден. Требуется генерация.</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <!--suppress ES6ConvertVarToLetConst -->
    <script>
      (function ($) {
        $('#sitemap').on('click', function () {
          var _b = $(this);
          _b.attr('disabled', 'disabled');
          $.post('{{ route('admin.settings.sitemap') }}', null, null, 'json')
            .done(function (json) {
              if ('result' in json && true === json['result']) {
                $('#sitemap-result').html('<span class="fw-bold text-teal">SiteMap успешно сгенерирован.</span>');
                Swal.fire('👌', 'SiteMap сгенерирован', 'success');
              }
            })
            .always(function () {
              _b.removeAttr('disabled');
            });
        });
      })(jQuery);
    </script>
@endpush