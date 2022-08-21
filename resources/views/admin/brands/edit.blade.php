<?php

/**
 * @var \App\Models\Brand $brand
 */

?>
@extends('layouts.admin')

@section('title', "Редактировать: {$brand->name}")
@section('description', "Редактировать: {$brand->name}")

@include('admin.brands.form', compact('brand'))
