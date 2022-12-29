<?php

/**
 * @var \App\Models\City     $city
 * @var \App\Models\User[]   $users
 */

?>
@extends('layouts.admin')

@section('title', 'Добавить город')
@section('description', 'Добавить город')

@include('admin.cities.form', compact('city', 'users'))
