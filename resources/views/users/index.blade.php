<?php

/**
 * @var \App\Models\User[] $users
 */

?>
@extends('layouts.app')

@section('title', 'Список всех авторов')
@section('description', 'Список всех авторов')

@push('styles')
    <link rel="stylesheet" href="/css/popularity.css?v=1">
    <link rel="stylesheet" href="/css/select2.css">
@endpush

@section('content')
    <main class="main">
        <div class="inner">
            <div class="wrap">
                @include('partials.breadcrumbs', ['data' => [['link' => '', 'title' => 'Авторы']]])
                <h1>Список авторов</h1>
                <div id="content">@include('users.users', compact('users'))</div>
            </div>
        </div>
    </main>
@endsection