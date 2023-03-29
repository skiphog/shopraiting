<?php

/**
 * @var \App\Models\Article $article
 * @var \App\Models\User $user
 */

?>
@extends('layouts.cabinet')

@section('title', "Редактировать: {$article->name}")
@section('description', "Редактировать: {$article->name}")

@include('cabinet.articles.form', compact('article', 'user'))
