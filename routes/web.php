<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\QuestionController;

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::group(['prefix' => 'recalls', 'as' => 'index.', 'middleware' => 'ajax'], static function () {
    Route::get('/', [IndexController::class, 'recalls'])->name('recalls');
    Route::get('/{shop:slug}', [IndexController::class, 'shopRecalls'])->name('shop-recalls');
});
Route::group(['prefix' => 'reviews', 'as' => 'reviews.'], static function () {
    Route::get('/', [ReviewController::class, 'index'])->name('index');
    Route::get('/{shop:slug}', [ReviewController::class, 'shop'])->name('shop');
    Route::get('/{shop:slug}/last', [ReviewController::class, 'last'])
        ->middleware('ajax')
        ->name('last');

    Route::post('/store', [ReviewController::class, 'store'])->name('store');

    Route::post('/{review}/like', [ReviewController::class, 'like'])->name('like');
});
Route::group(['prefix' => 'shops', 'as' => 'shops.'], static function () {
    Route::get('/', [ShopController::class, 'index'])->name('index');
    Route::get('/{shop:slug}', [ShopController::class, 'show'])->name('show');
    Route::get('/{shop:slug}/reviews', [ShopController::class, 'reviews'])->name('reviews');
});
Route::group(['prefix' => 'brands', 'as' => 'brands.'], static function () {
    Route::get('/', [BrandController::class, 'index'])->name('index');
    Route::get('/{brand:slug}/reviews', [BrandController::class, 'reviews'])->name('reviews');
});
Route::group(['prefix' => 'articles', 'as' => 'articles.'], static function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('/{article:slug}', [ArticleController::class, 'show'])->name('show');
    Route::post('/{article}/vote', [ArticleController::class, 'vote'])->name('vote');
    Route::post('/{article}/comment/store', [CommentController::class, 'article'])->name('comment.store');
});
Route::group(['prefix' => 'questions', 'as' => 'questions.'], static function () {
    Route::get('/', [QuestionController::class, 'index'])->name('index');
    Route::get('/{question}', [QuestionController::class, 'show'])->name('show');
});
Route::group(['prefix' => 'feedback', 'as' => 'questions.'], static function () {
    Route::get('/', [QuestionController::class, 'create'])->name('create');
    Route::post('/', [QuestionController::class, 'store'])->name('store');
});
Route::group(['prefix' => 'cities', 'as' => 'cities.'], static function () {
    Route::get('/', [CityController::class, 'index'])->name('index');
    Route::get('/{city:slug}', [CityController::class, 'show'])->name('show');

    Route::group(['prefix' => 'recalls', 'as' => 'recalls.', 'middleware' => 'ajax'], static function () {
        Route::get('/{city:slug}', [CityController::class, 'recalls'])->name('recalls');
        Route::get('/{city:slug}/{shop:slug}', [CityController::class, 'shopRecalls'])->name('shop-recalls');
    });
});
Route::group(['prefix' => 'authors', 'as' => 'authors.'], static function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/{user:slug}', [UserController::class, 'show'])->name('show');
});

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/test', [TestController::class, 'index'])->name('test');

require __DIR__ . '/auth.php';
