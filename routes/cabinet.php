<?php

use App\Http\Controllers\Cabinet\IndexController;
use App\Http\Controllers\Cabinet\ProfileController;
use App\Http\Controllers\Cabinet\ArticleController;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::group(['prefix' => 'profile', 'as' => 'profile.'], static function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::post('/update', [ProfileController::class, 'update'])->name('update');
    Route::post('/password', [ProfileController::class, 'password'])->name('password');
    Route::post('/avatar', [ProfileController::class, 'avatar'])->name('avatar');
});

Route::group(['prefix' => 'articles', 'as' => 'articles.'], static function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('/create', [ArticleController::class, 'create'])->name('create');
    Route::post('/create', [ArticleController::class, 'store'])->name('store');
    Route::get('/{article_id}/edit', [ArticleController::class, 'edit'])->name('edit');
    Route::post('/{article_id}/edit', [ArticleController::class, 'update'])->name('update');
    Route::post('/{article_id}/destroy', [ArticleController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'search', 'as' => 'search.'], static function () {
    Route::get('/articles', [ArticleController::class, 'search'])->name('articles');
});
