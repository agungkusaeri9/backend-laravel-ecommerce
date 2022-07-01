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

// auth
Route::post('register',RegisterController::class);
Route::post('login',LoginController::class);
Route::post('logout',LogoutController::class);

// products
Route::get('products','ProductController@all');
Route::get('products/search','ProductController@search');
Route::get('products/{slug}','ProductController@show');

// province
Route::get('provinces','ProvinceController@all');

// get city by province_id
Route::get('city/{province_id}/province','CityController@getByProvince');

// courier
Route::get('couriers',CourierController::class);
Route::get('payments',PaymentController::class);

Route::middleware('auth:api')->group(function(){
    // cart
    Route::get('cart','CartController@get');
    Route::delete('cart/{id}','CartController@destroy');
    Route::post('add-to-cart','CartController@addToCart');

    // transactions
    Route::get('transactions','TransactionController@get');
    Route::get('transactions/{transaction_id}','TransactionController@show');

    // profile
    Route::get('profile','ProfileController@show');
    Route::patch('profile','ProfileController@update');

    // update password
    Route::patch('change-password',PasswordController::class);

    //checkout
    Route::post('checkout','CheckoutController');
});

