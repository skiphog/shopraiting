<?php

/**
 * @var \App\Models\City[] $cities
 */

?>
@extends('layouts.app')

@section('title', 'Список всех городов')
@section('description', 'Список всех городов')

@push('styles')
    <link rel="stylesheet" href="/css/popularity.css?v=1">
@endpush

@section('content')
    <main class="main">
        <div class="inner">
            <div class="wrap">
                @include('partials.breadcrumbs', ['data' => [['link' => '', 'title' => 'Города']]])
                <h1>Список городов</h1>
                <div id="content">@include('cities.cities', compact('cities'))</div>
            </div>
        </div>
    </main>
@endsection