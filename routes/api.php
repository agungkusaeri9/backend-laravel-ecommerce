<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\RegisterController;
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
Route::prefix('auth')->group(function () {
    // Route::post('register', RegisterController::class);
    // Route::post('login', LoginController::class);
    // Route::post('logout', LogoutController::class);

    Route::post('register', [RegisterController::class, 'register']);
    Route::post('login', [LoginController::class, 'login']);
});

// products
Route::get('products', 'ProductController@all');
Route::get('products/search', 'ProductController@search');
Route::get('products/{slug}', 'ProductController@show');

Route::get('product-categories', 'ProductCategoryController@getAll');


// province
Route::get('provinces', 'ProvinceController@all');

// get city by province_id
Route::get('city/{province_id}/province', 'CityController@getByProvince');

// courier
Route::get('couriers', CourierController::class);
Route::get('payments', PaymentController::class);

Route::middleware('auth-jwt')->group(function () {
    // cart
    Route::get('cart', 'CartController@get');
    Route::delete('cart/{id}', 'CartController@destroy');
    Route::post('cart/add-to-cart', 'CartController@addToCart');

    // transactions
    Route::get('transactions', 'TransactionController@get');
    Route::get('transactions/{transaction_id}', 'TransactionController@show');

    // profile
    Route::get('profile', 'ProfileController@show');
    Route::patch('profile', 'ProfileController@update');

    // update password
    Route::patch('change-password', PasswordController::class);

    //checkout
    Route::post('checkout', 'CheckoutController');
});
