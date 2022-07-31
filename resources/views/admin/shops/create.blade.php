<?php

/**
 * @var \App\Models\Shop $shop
 */

?>
@extends('layouts.admin')

@section('title', 'Добавить магазин')
@section('description', 'Добавить магазин')

@include('admin.shops.form', compact('shop'))
