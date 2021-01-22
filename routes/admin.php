<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@index')->name('dashboard');
Route::resource('users', 'UserController');
Route::resource('payments', 'PaymentController');
Route::resource('product-categories', 'ProductCategoryController');
Route::resource('products', 'ProductController');
Route::resource('product-galleries', 'ProductGalleryController');
Route::resource('shipments', 'ShipmentController');
Route::resource('transactions', 'TransactionController');