<?php

/**
 * @var \App\Models\User $user
 * @var \App\Models\Article $article
 */

?>
@extends('layouts.cabinet')

@section('title', "Редактировать: {$article->name}")
@section('description', "Редактировать: {$article->name}")

@include('cabinet.articles.form', compact('article', 'user'))
