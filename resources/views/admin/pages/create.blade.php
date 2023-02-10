<?php

/**
 * @var \App\Models\Page   $page
 * @var \App\Models\User[] $users
 */

?>
@extends('layouts.admin')

@section('title', 'Добавить страницу')
@section('description', 'Добавить страницу')

@include('admin.pages.form', compact('page', 'users'))
