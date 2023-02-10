<?php

/**
 * @var \App\Models\Page   $page
 * @var \App\Models\User[] $users
 */

?>
@extends('layouts.admin')

@section('title', "Редактировать: {$page->name}")
@section('description', "Редактировать: {$page->name}")

@include('admin.pages.form', compact('page', 'users'))
