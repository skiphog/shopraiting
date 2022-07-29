<?php

/**
 * @var \App\Models\Article $article
 * @var \App\Models\User[]  $users
 */

?>
@extends('layouts.admin')

@section('title', 'Добавить статью')
@section('description', 'Добавить статью')

@include('admin.articles.form', compact('article', 'users'))
