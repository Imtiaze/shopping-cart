<?php

// use Illuminate\Support\Facades\Route;

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





Route::get('/shopping-cart', 'ShoppingCartController@cart');
Route::post('/fetch-item', 'ShoppingCartController@fetchItem');
Route::post('/fetch-cart', 'ShoppingCartController@fetchCart');
Route::post('/action', 'ShoppingCartController@addToCart');
Route::post('/remove-from-cart', 'ShoppingCartController@removeFromCart');

Route::get('/', function () {
    return view('welcome');
});
