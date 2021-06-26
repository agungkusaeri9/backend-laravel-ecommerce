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
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{slug}', 'ProductController@show')->name('product.show');
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', 'CartController@index')->name('cart.index');
    Route::post('/cart', 'CartController@store')->name('cart.store');
    Route::delete('/cart/{id}', 'CartController@destroy')->name('cart.destroy');
    Route::get('province/{id}/city', 'CekOngkirController@getCity')->name('getCity');
    Route::get('get-payments/{id}', 'HomeController@getPayment')->name('getPayment');
    Route::post('/cekongkir', 'CekOngkirController@cekOngkir')->name('cekOngkir'); 
    Route::post('/checkout', 'CheckoutController')->name('checkout'); 
    Route::get('/success', function(){
        if(session('success')){
            return view('user.pages.success');
        }else{
            return redirect()->route('home');
        }
    })->name('transactions.success'); 
});