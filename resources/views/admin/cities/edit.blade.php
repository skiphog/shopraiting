<?php

/**
 * @var \App\Models\City     $city
 */

?>
@extends('layouts.admin')

@section('title', "Редактировать: {$city->name}")
@section('description', "Редактировать: {$city->name}")

@include('admin.cities.form', compact('city'))
