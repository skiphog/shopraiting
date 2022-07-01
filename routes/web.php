<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ArticleController;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::group(['prefix' => 'reviews', 'as' => 'reviews.'], static function () {
    Route::get('/', [ReviewController::class, 'index'])->name('index');
    Route::get('/{shop:slug}', [ReviewController::class, 'shop'])->name('shop');
    Route::get('/{shop:slug}/last', [ReviewController::class, 'last'])->name('last');
    Route::post('/store', [ReviewController::class, 'store'])->name('store');
});

Route::group(['prefix' => 'shops', 'as' => 'shops.'], static function () {
    Route::get('/', [ShopController::class, 'index'])->name('index');
    Route::get('/{shop:slug}', [ShopController::class, 'show'])->name('show');
});

Route::group(['prefix' => 'articles', 'as' => 'articles.'], static function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('/{article:slug}', [ArticleController::class, 'show'])->name('show');
});

Route::get('/authors', [UserController::class, 'authors'])->name('authors');
Route::get('/about', [PageController::class, 'about'])->name('about');
