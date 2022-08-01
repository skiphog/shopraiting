<?php

/**
 * @var \App\Models\Category $category
 * @var \App\Models\User[]   $users
 */

?>
@extends('layouts.admin')

@section('title', "Редактировать: {$category->name}")
@section('description', "Редактировать: {$category->name}")

@include('admin.categories.form', compact('category', 'users'))
