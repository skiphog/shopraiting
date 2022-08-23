<?php

/**
 * @var \App\Models\Banner $banner
 */

?>
@extends('layouts.admin')

@section('title', 'Добавить Банер')
@section('description', 'Добавить Банер')

@include('admin.banners.form', compact('banner'))
