<?php

/**
 * @var \App\Models\Article $article
 * @var \App\Models\User  $user
 */

?>
@extends('layouts.cabinet')

@section('title', 'Добавить статью')
@section('description', 'Добавить статью')

@include('cabinet.articles.form', compact('article', 'user'))
