<?php

/**
 * @var \App\Models\Article[] $articles
 */

?>
@extends('layouts.app')

@section('title', 'Статьи о сексшопах и секс игрушках')
@section('description', 'Статьи о сексшопах и секс игрушках')

@push('styles')

@endpush

@section('content')
    <main class="main">
        <div class="inner">
            <div class="wrap">
                @include('partials.breadcrumbs', ['data' => [['link' => '', 'title' => 'Статьи']]])
                <h1>Статьи о сексшопах</h1>
                <div class="content">
                    @include('partials.slider')
                    <div class="main-content">
                        @print.workArea
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection