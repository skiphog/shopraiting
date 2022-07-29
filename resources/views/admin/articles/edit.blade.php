<?php

/**
 * @var \App\Models\Article $article
 * @var \App\Models\User[] $users
 */

?>
@extends('layouts.admin')

@section('title', "Редактировать: {$article->name}")
@section('description', "Редактировать: {$article->name}")

@include('admin.articles.form', compact('article', 'users'))
