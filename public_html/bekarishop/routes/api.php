<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'electric-v1'], function(){


    Route::resource('/categories', App\Http\Controllers\Api\CategoryController::class);
    Route::resource('/brands', App\Http\Controllers\Api\BrandController::class);
    Route::resource('/banners', App\Http\Controllers\Api\BannerController::class);
    Route::resource('/posts', App\Http\Controllers\Api\PostController::class);
    Route::resource('/products', App\Http\Controllers\Api\ProductController::class);
    Route::resource('/services', App\Http\Controllers\Api\ServiceController::class);

    Route::post('/contactus', [App\Http\Controllers\Api\ContactusController::class, 'store']);
    Route::post('/appointment', [App\Http\Controllers\Api\ContactusController::class, 'appointment']);
    Route::post('/subscription', [App\Http\Controllers\Api\ContactusController::class, 'subscription']);


    //Site Info
    Route::get('/site_logo', [App\Http\Controllers\Api\SiteController::class, 'site_logo']);
    Route::get('/site_info', [App\Http\Controllers\Api\SiteController::class, 'site_info']);
    Route::get('/social_link', [App\Http\Controllers\Api\SiteController::class, 'social_link']);
    Route::get('/site_seo', [App\Http\Controllers\Api\SiteController::class, 'site_seo']);

	Route::get('/{slug}', [App\Http\Controllers\Api\SlugController::class, 'index'])->name('/');




});