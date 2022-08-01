<?php

/**
 * @var \App\Models\Category $category
 * @var \App\Models\User[]   $users
 */

?>
@extends('layouts.admin')

@section('title', 'Добавить категорию')
@section('description', 'Добавить категорию')

@include('admin.categories.form', compact('category', 'users'))
