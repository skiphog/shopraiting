<?php

/**
 * @var \App\Models\Article $article
 */

?>
@extends('layouts.app')

@section('og_image')
    <meta property="og:image" content="{{ asset($article->img) }}">
@endsection

