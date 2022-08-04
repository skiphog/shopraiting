<?php

/**
 * @var \App\Models\Shop $shop
 */

?>
@extends('layouts.admin')

@section('title', "Редактировать: {$shop->name}")
@section('description', "Редактировать: {$shop->name}")

@include('admin.shops.form', compact('shop'))

@if($shop->id)
    @section('modal')
        <div class="modal fade" tabindex="-1" role="dialog" id="edit-coupons">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Купоны и акции магазина «{{ $shop->name }}»</h5>
                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <div class="modal-body modal-body-md">
                        <form action="#" class="mt-4 crutch-validate is-alter">
                            <div class="row g-gs">
                                <div class="col-md-12">

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
@endif
