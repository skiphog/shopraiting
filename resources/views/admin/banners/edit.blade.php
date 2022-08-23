<?php

/**
 * @var \App\Models\Banner $banner
 */

?>
@extends('layouts.admin')

@section('title', "Редактировать: {$banner->name}")
@section('description', "Редактировать: {$banner->name}")

@include('admin.banners.form', compact('banner'))
