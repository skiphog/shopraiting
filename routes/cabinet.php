<?php

use App\Http\Controllers\Cabinet\IndexController;
use App\Http\Controllers\Cabinet\ProfileController;
use App\Http\Controllers\Cabinet\ArticleController;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::group(['prefix' => 'profile', 'as' => 'profile.'], static function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
});

Route::group(['prefix' => 'articles', 'as' => 'articles.'], static function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
});
