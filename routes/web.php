<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return redirect('/admin/product-price');
});

Route::middleware(['checkAuth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/product-price', 'Admin\ProductPriceController@index')->name('product-price.index');
        Route::get('/product-price/create', 'Admin\ProductPriceController@create')->name('product-price.create');
        Route::post('/product-price/create', 'Admin\ProductPriceController@store')->name('product-price.insert');
    });
});

Auth::routes();

Route::fallback(function () {
    return redirect('/login');
})->name('fallback.404');
