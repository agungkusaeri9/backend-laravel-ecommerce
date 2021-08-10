<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/edit-profile', 'ProfileController@edit')->name('profile.edit');
Route::patch('/edit-profile', 'ProfileController@update')->name('profile.update');
Route::resource('users', 'UserController')->except('show');
Route::resource('payments', 'PaymentController')->except('show');
Route::resource('product-categories', 'ProductCategoryController')->except('show');;
Route::post('/products/filter', 'ProductController@index')->name('products.filter');
Route::resource('products', 'ProductController');
Route::resource('product-galleries', 'ProductGalleryController');
Route::post('product-galleries/search', 'ProductGalleryController@index')->name('product-galleries.search');
Route::resource('transactions', 'TransactionController');
Route::get('/transactions/{id}/set', 'TransactionController@set')->name('transactions.set');
Route::get('/transactions/{id}/download', 'TransactionController@download')->name('transactions.download');
Route::get('/store', 'StoreController@index')->name('store.index');
Route::post('/store', 'StoreController@store')->name('store.store');
Route::get('/store/province/{id}/city', 'StoreController@getCity')->name('store.get-city');

// report
Route::get('report/transaction','ReportController@transaction')->name('report.transaction');
Route::get('report/transaction/print','ReportController@transactionPrint')->name('report.transaction.print');
Route::post('report/transaction','ReportController@transaction')->name('report.transaction.filter');