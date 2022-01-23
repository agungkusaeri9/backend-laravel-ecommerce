<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/edit-profile', 'ProfileController@edit')->name('profile.edit');
Route::patch('/edit-profile', 'ProfileController@update')->name('profile.update');
Route::resource('users', 'UserController')->except('show');
Route::resource('payments', 'PaymentController')->except('show');
Route::resource('product-categories', 'ProductCategoryController')->except('show');;
Route::resource('products', 'ProductController')->except('store');
Route::post('/products', 'ProductController@index')->name('products.filter');
Route::post('/products/create', 'ProductController@store')->name('products.store');
Route::resource('product-galleries', 'ProductGalleryController')->except('store');
Route::post('/product-galleries/create', 'ProductGalleryController@store')->name('product-galleries.store');
Route::post('product-galleries/', 'ProductGalleryController@index')->name('product-galleries.search');
Route::post('product-galleries/{product_id}/{id}/set-active', 'ProductGalleryController@setActive')->name('product-galleries.setActive');
Route::resource('transactions', 'TransactionController')->except('store','create');
Route::post('transactions','TransactionController@index')->name('transactions.filter');
Route::get('/transactions/{id}/set', 'TransactionController@set')->name('transactions.set');
Route::get('/transactions/{id}/download', 'TransactionController@download')->name('transactions.download');
Route::get('/store', 'StoreController@index')->name('store.index');
Route::post('/store', 'StoreController@store')->name('store.store');
Route::get('/store/province/{id}/city', 'StoreController@getCity')->name('store.get-city');

// report
Route::get('report/transaction','ReportController@transaction')->name('report.transaction');
Route::get('report/transaction/print','ReportController@transactionPrint')->name('report.transaction.print');
Route::get('report/transaction/export','ReportController@transactionExport')->name('report.transaction.export');
Route::post('report/transaction','ReportController@transaction')->name('report.transaction.filter');

// trash user
Route::get('trash/user','TrashController@user')->name('trash.user.index');
Route::post('trash/user/{id}/restore','TrashController@userRestore')->name('trash.user.restore');
Route::delete('trash/user/{id}/delete','TrashController@userDelete')->name('trash.user.delete');

// trash product
Route::get('trash/product','TrashController@product')->name('trash.product.index');
Route::post('trash/product/{id}/restore','TrashController@productRestore')->name('trash.product.restore');
Route::delete('trash/product/{id}/delete','TrashController@productDelete')->name('trash.product.delete');

// trash transaction
Route::get('trash/transaction','TrashController@transaction')->name('trash.transaction.index');
Route::post('trash/transaction/{id}/restore','TrashController@transactionRestore')->name('trash.transaction.restore');
Route::delete('trash/transaction/{id}/delete','TrashController@transactionDelete')->name('trash.transaction.delete');