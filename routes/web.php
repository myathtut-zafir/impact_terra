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
    return redirect('/admin/market-price');
});

Route::middleware(['checkAuth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/market-price', 'Admin\ProductPriceController@index')->name('market-price.index');
        Route::get('/market-price/create', 'Admin\ProductPriceController@create')->name('market-price.create');
        Route::post('/market-price/create', 'Admin\ProductPriceController@store')->name('market-price.insert');
    });
});

Auth::routes();

Route::fallback(function () {
    return redirect('/login');
})->name('fallback.404');
