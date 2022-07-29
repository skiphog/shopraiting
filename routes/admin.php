<?php

use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\ArticleController;

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::group(['prefix' => 'shops', 'as' => 'shops.', 'middleware' => []], static function () {
    Route::get('/', [ShopController::class, 'index'])
        ->name('index');
    Route::get('/create', [ShopController::class, 'create'])
        ->name('create');
    Route::post('/create', [ShopController::class, 'store'])
        ->name('store');
    Route::get('/{shop_id}/edit', [ShopController::class, 'edit'])
        ->whereNumber('shop_id')
        ->name('edit');
    Route::post('/{shop_id}/edit', [ShopController::class, 'update'])
        ->whereNumber('shop_id')
        ->name('update');
    Route::post('/{shop_id}/destroy', [ShopController::class, 'destroy'])
        ->whereNumber('shop_id')
        ->name('destroy');
});
Route::group(['prefix' => 'reviews', 'as' => 'reviews.', 'middleware' => []], static function () {
    Route::get('/', [ReviewController::class, 'index'])
        ->name('index');
    Route::get('/{review_id}/edit', [ReviewController::class, 'edit'])
        ->whereNumber('review_id')
        ->name('edit');
    Route::post('/{review_id}/edit', [ReviewController::class, 'update'])
        ->whereNumber('review_id')
        ->name('update');
    Route::post('/{review_id}/destroy', [ReviewController::class, 'destroy'])
        ->whereNumber('review_id')
        ->name('destroy');
});
Route::group(['prefix' => 'articles', 'as' => 'articles.', 'middleware' => []], static function () {
    Route::get('/', [ArticleController::class, 'index'])
        ->name('index');
    Route::get('/create', [ArticleController::class, 'create'])
        ->name('create');
    Route::post('/create', [ArticleController::class, 'store'])
        ->name('store');
    Route::get('/{article_id}/edit', [ArticleController::class, 'edit'])
        ->whereNumber('review_id')
        ->name('edit');
    Route::post('/{article_id}/edit', [ArticleController::class, 'update'])
        ->whereNumber('review_id')
        ->name('update');
    Route::post('/{article_id}/destroy', [ArticleController::class, 'destroy'])
        ->whereNumber('review_id')
        ->name('destroy');
});
Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => []], static function () {
    Route::get('/', [UserController::class, 'index'])
        ->name('index');
    Route::get('/{user}/edit', [UserController::class, 'edit'])
        ->name('edit');
    Route::post('/{user}/edit', [UserController::class, 'update'])
        ->name('update');
});
Route::group(['prefix' => 'search', 'as' => 'search.'], static function () {
    Route::get('/shops', [ShopController::class, 'search'])
        ->name('shops');
    Route::get('/reviews', [ReviewController::class, 'search'])
        ->name('review');
    Route::get('/articles', [ArticleController::class, 'search'])
        ->name('articles');
    Route::get('/users', [UserController::class, 'search'])
        ->name('users');
});