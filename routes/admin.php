<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@index')->name('dashboard');
Route::resource('users', 'UserController')->except('show');
Route::resource('payments', 'PaymentController');
Route::resource('product-categories', 'ProductCategoryController');
Route::resource('products', 'ProductController');
Route::resource('product-galleries', 'ProductGalleryController');
Route::post('product-galleries/search', 'ProductGalleryController@index')->name('product-galleries.search');
Route::resource('shipments', 'ShipmentController');
Route::resource('transactions', 'TransactionController');
Route::get('/transactions/{id}/set', 'TransactionController@set')->name('transactions.set');
Route::get('/transactions/{id}/download', 'TransactionController@download')->name('transactions.download');
Route::get('/store', 'StoreController@index')->name('store.index');
Route::post('/store', 'StoreController@store')->name('store.store');
Route::get('/store/province/{id}/city', 'StoreController@getCity')->name('store.get-city');