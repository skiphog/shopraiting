<?php

/**
 * @var \App\Models\City     $city
 */

?>
@extends('layouts.admin')

@section('title', 'Добавить город')
@section('description', 'Добавить город')

@include('admin.cities.form', compact('city'))
