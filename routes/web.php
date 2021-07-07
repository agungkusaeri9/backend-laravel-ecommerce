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
Route::get('/contact', 'ContactController')->name('contact');
Route::get('/about', 'AboutController')->name('about');
Route::prefix('products')->group(function () {
    Route::get('', 'ProductController@index')->name('product.index');
    Route::get('{slug}', 'ProductController@show')->name('product.show');
    Route::get('category/{slug}', 'ProductController@index')->name('product.category');
});
Route::middleware(['auth'])->group(function () {

    // account
    Route::prefix('account')->group(function () {
        Route::get('/', 'AccountController@show')->name('account.show');
        Route::patch('/', 'AccountController@update')->name('account.update');
    });

    // order/transaction
    Route::prefix('order')->group(function () {
        Route::get('/', 'TransactionController@index')->name('transactions.index');
        Route::get('/{id}', 'TransactionController@show')->name('transactions.show');
        Route::post('/upload', 'TransactionController@upload_proof')->name('transactions.upload-proof'); 
    });
    
    Route::get('/cart', 'CartController@index')->name('cart.index');
    Route::post('/cart', 'CartController@store')->name('cart.store');
    Route::delete('/cart/{id}', 'CartController@destroy')->name('cart.destroy');
    Route::get('province/{id}/city', 'CekOngkirController@getCity')->name('getCity');
    Route::get('get-payments/{id}', 'HomeController@getPayment')->name('getPayment');
    Route::post('/cekongkir', 'CekOngkirController@cekOngkir')->name('cekOngkir'); 
    Route::post('/checkout', 'CheckoutController')->name('checkout'); 
    Route::get('/success', function(){
        if(session('transaction_id')){
            return view('user.pages.success');
        }else{
            return redirect()->route('home');
        }
    })->name('transactions.success'); 
});