<?php

/**
 * @var \App\Models\Banner $banner
 */

?>
@extends('layouts.admin')

@section('title', 'Добавить баннер')
@section('description', 'Добавить баннер')

@include('admin.banners.form', compact('banner'))
