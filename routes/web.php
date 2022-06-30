<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ArticleController;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');
Route::get('/reviews/{shop:slug}', [ReviewController::class, 'shop'])->name('reviews.shop');
Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');

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
