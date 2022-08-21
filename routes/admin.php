<?php

use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\CategoryController;

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
    Route::get('/{shop_id}/edit/coupons', [CouponController::class, 'edit'])
        ->whereNumber('shop_id')
        ->name('coupons.edit');
    Route::post('/{shop_id}/edit/coupons', [CouponController::class, 'update'])
        ->whereNumber('shop_id')
        ->name('coupons.update');
});
Route::group(['prefix' => 'brands', 'as' => 'brands.', 'middleware' => []], static function () {
    Route::get('/', [BrandController::class, 'index'])
        ->name('index');
    Route::get('/create', [BrandController::class, 'create'])
        ->name('create');
    Route::post('/create', [BrandController::class, 'store'])
        ->name('store');
    Route::get('/{brand_id}/edit', [BrandController::class, 'edit'])
        ->whereNumber('brand_id')
        ->name('edit');
    Route::post('/{brand_id}/edit', [BrandController::class, 'update'])
        ->whereNumber('brand_id')
        ->name('update');
    Route::post('/{brand_id}/destroy', [BrandController::class, 'destroy'])
        ->whereNumber('brand_id')
        ->name('destroy');
});
Route::group(['prefix' => 'categories', 'as' => 'categories.', 'middleware' => []], static function () {
    Route::get('/', [CategoryController::class, 'index'])
        ->name('index');
    Route::get('/create', [CategoryController::class, 'create'])
        ->name('create');
    Route::post('/create', [CategoryController::class, 'store'])
        ->name('store');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])
        ->name('edit');
    Route::post('/{category}/edit', [CategoryController::class, 'update'])
        ->name('update');
    Route::post('/{category}/destroy', [CategoryController::class, 'destroy'])
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
Route::group(['prefix' => 'comments', 'as' => 'comments.', 'middleware' => []], static function () {
    Route::get('/', [CommentController::class, 'index'])
        ->name('index');
    Route::get('/{comment_id}/edit', [CommentController::class, 'edit'])
        ->whereNumber('comment_id')
        ->name('edit');
    Route::post('/{comment_id}/edit', [CommentController::class, 'update'])
        ->whereNumber('comment_id')
        ->name('update');
    Route::post('/{comment_id}/destroy', [CommentController::class, 'destroy'])
        ->whereNumber('comment_id')
        ->name('destroy');
});
Route::group(['prefix' => 'questions', 'as' => 'questions.', 'middleware' => []], static function () {
    Route::get('/', [QuestionController::class, 'index'])
        ->name('index');
    Route::get('/{question_id}/edit', [QuestionController::class, 'edit'])
        ->whereNumber('question_id')
        ->name('edit');
    Route::post('/{question_id}/edit', [QuestionController::class, 'update'])
        ->whereNumber('question_id')
        ->name('update');
    Route::post('/{question_id}/destroy', [QuestionController::class, 'destroy'])
        ->whereNumber('question_id')
        ->name('destroy');
});
Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => []], static function () {
    Route::get('/', [UserController::class, 'index'])
        ->name('index');
    Route::get('/{user}/edit', [UserController::class, 'edit'])
        ->name('edit');
    Route::post('/{user}/edit', [UserController::class, 'update'])
        ->name('update');
    Route::post('/{user}/password', [UserController::class, 'password'])
        ->name('password');
});
Route::group(['prefix' => 'settings', 'as' => 'settings.', 'middleware' => []], static function () {
    Route::get('/', [SettingController::class, 'index'])->name('index');
    Route::post('/sitemap', [SettingController::class, 'sitemap'])->name('sitemap');
});
Route::group(['prefix' => 'search', 'as' => 'search.'], static function () {
    Route::get('/shops', [ShopController::class, 'search'])->name('shops');
    Route::get('/brands', [BrandController::class, 'search'])->name('brands');
    Route::get('/reviews', [ReviewController::class, 'search'])->name('review');
    Route::get('/articles', [ArticleController::class, 'search'])->name('articles');
    Route::get('/users', [UserController::class, 'search'])->name('users');
    Route::get('/comments', [CommentController::class, 'search'])->name('comments');
    Route::get('/questions', [QuestionController::class, 'search'])->name('questions');
    Route::get('/categories', [CategoryController::class, 'search'])->name('categories');
});
