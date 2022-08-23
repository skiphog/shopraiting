<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['prefix' => 'services', 'as' => 'services.'], static function () {
    Route::post('/slugify', [ServiceController::class, 'slugify'])
        ->name('slugify');

    Route::group(['prefix' => 'upload', 'as' => 'upload.'], static function () {
        Route::post('/base', [ServiceController::class, 'uploadBase'])
            ->name('base');
        Route::post('/shop', [ServiceController::class, 'uploadShopLogo'])
            ->name('shop');
        Route::post('/banner', [ServiceController::class, 'uploadBanner'])
            ->name('banner');
    });
});