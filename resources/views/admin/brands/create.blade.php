<?php

/**
 * @var \App\Models\Brand $brand
 */

?>
@extends('layouts.admin')

@section('title', 'Добавить Бренд')
@section('description', 'Добавить Бренд')

@include('admin.brands.form', compact('brand'))
