<?php

/**
 * @var \App\Models\City     $city
 * @var \App\Models\User[]   $users
 */

?>
@extends('layouts.admin')

@section('title', "Редактировать: {$city->name}")
@section('description', "Редактировать: {$city->name}")

@include('admin.cities.form', compact('city', 'users'))
