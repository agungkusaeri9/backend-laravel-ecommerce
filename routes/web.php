<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{product:slug}', 'ProductController@show')->name('product.show');
Route::get('/kategori/{category:slug}', 'ProductController@category')->name('product.category');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/cart', 'CartController@index')->name('cart.index');
    Route::post('/cart/{product:slug}', 'CartController@store')->name('cart.store');
    Route::delete('/cart/{cart:id}', 'CartController@destroy')->name('cart.destroy');
    Route::get('/checkout/{cart:id}', 'TransactionController@checkout')->name('checkout');
    Route::post('/checkout/{cart:id}', 'TransactionController@store')->name('transaction.store');

    Route::get('/transactions', 'TransactionController@index')->name('transaction.index');
    Route::get('/transactions/{transaction:uuid}', 'TransactionController@confirmation')->name('transaction.confirmation');

});
