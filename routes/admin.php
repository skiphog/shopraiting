<?php

use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\QuestionController;

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
Route::group(['prefix' => 'banners', 'as' => 'banners.', 'middleware' => []], static function () {
    Route::get('/', [BannerController::class, 'index'])
        ->name('index');
    Route::get('/create', [BannerController::class, 'create'])
        ->name('create');
    Route::post('/create', [BannerController::class, 'store'])
        ->name('store');
    Route::get('/{banner_id}/edit', [BannerController::class, 'edit'])
        ->whereNumber('banner_id')
        ->name('edit');
    Route::post('/{banner_id}/edit', [BannerController::class, 'update'])
        ->whereNumber('banner_id')
        ->name('update');
    Route::post('/{banner_id}/destroy', [BannerController::class, 'destroy'])
        ->whereNumber('banner_id')
        ->name('destroy');
});
Route::group(['prefix' => 'pages', 'as' => 'pages.', 'middleware' => []], static function () {
    Route::get('/', [PageController::class, 'index'])
        ->name('index');
    Route::get('/create', [PageController::class, 'create'])
        ->name('create');
    Route::post('/create', [PageController::class, 'store'])
        ->name('store');
    Route::get('/{page}/edit', [PageController::class, 'edit'])
        ->name('edit');
    Route::post('/{page}/edit', [PageController::class, 'update'])
        ->name('update');
    Route::post('/{page}/destroy', [PageController::class, 'destroy'])
        ->name('destroy');
});
Route::group(['prefix' => 'cities', 'as' => 'cities.', 'middleware' => []], static function () {
    Route::get('/', [CityController::class, 'index'])
        ->name('index');
    Route::get('/create', [CityController::class, 'create'])
        ->name('create');
    Route::post('/create', [CityController::class, 'store'])
        ->name('store');
    Route::get('/{city}/edit', [CityController::class, 'edit'])
        ->name('edit');
    Route::post('/{city}/edit', [CityController::class, 'update'])
        ->name('update');
    Route::post('/{city}/destroy', [CityController::class, 'destroy'])
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
    Route::get('/banners', [BannerController::class, 'search'])->name('banners');
    Route::get('/reviews', [ReviewController::class, 'search'])->name('review');
    Route::get('/articles', [ArticleController::class, 'search'])->name('articles');
    Route::get('/users', [UserController::class, 'search'])->name('users');
    Route::get('/comments', [CommentController::class, 'search'])->name('comments');
    Route::get('/questions', [QuestionController::class, 'search'])->name('questions');
    Route::get('/pages', [PageController::class, 'search'])->name('pages');
    Route::get('/cities', [CityController::class, 'search'])->name('cities');
});
