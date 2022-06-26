<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ArticleController;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::group(['prefix' => 'shops', 'as' => 'shops.'], static function () {
    Route::get('/', [ShopController::class, 'index'])->name('index');
    Route::get('/{shop:slug}', [ShopController::class, 'show'])->name('show');
});

Route::group(['prefix' => 'articles', 'as' => 'articles.'], static function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('/{article:slug}', [ArticleController::class, 'show'])->name('show');
});
