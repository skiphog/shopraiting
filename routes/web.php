<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::group(['prefix' => 'recalls', 'as' => 'index.', 'middleware' => 'ajax'], static function () {
    Route::get('/', [IndexController::class, 'recalls'])->name('recalls');
    Route::get('/{shop:slug}', [IndexController::class, 'shopRecalls'])->name('shop-recalls');
});
Route::group(['prefix' => 'reviews', 'as' => 'reviews.'], static function () {
    Route::get('/', [ReviewController::class, 'index'])->name('index');
    Route::get('/{shop:slug}', [ReviewController::class, 'shop'])->name('shop');
    Route::get('/{shop:slug}/last', [ReviewController::class, 'last'])->name('last');
    Route::post('/store', [ReviewController::class, 'store'])->name('store');
    Route::post('/{review}/like', [ReviewController::class, 'like'])->name('like');
});
Route::group(['prefix' => 'shops', 'as' => 'shops.'], static function () {
    Route::get('/', [ShopController::class, 'index'])->name('index');
    Route::get('/{shop:slug}', [ShopController::class, 'show'])->name('show');
    Route::get('/{shop:slug}/reviews', [ShopController::class, 'reviews'])->name('reviews');
});
Route::group(['prefix' => 'articles', 'as' => 'articles.'], static function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('/{article:slug}', [ArticleController::class, 'show'])->name('show');
    Route::post('/{article}/vote', [ArticleController::class, 'vote'])->name('vote');
    Route::post('/{article}/comment/store', [CommentController::class, 'article'])->name('comment.store');
});
Route::get('/authors', [UserController::class, 'authors'])->name('authors');

Route::get('/about', [PageController::class, 'about'])->name('about');

require __DIR__ . '/auth.php';
