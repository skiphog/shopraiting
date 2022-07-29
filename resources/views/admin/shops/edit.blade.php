<?php

/**
 * @var \App\Models\Shop $shop
 */

?>
@extends('layouts.admin')

@section('title', "Редактировать: {$shop->name}")
@section('description', "Редактировать: {$shop->name}")

@include('admin.shops.form', compact('shop'));
