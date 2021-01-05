<?php

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

// VIEWS
Auth::routes();

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/products', 'ProductController@index')->name('products');
Route::get('/products/{product}', 'ProductController@detail')->name('product');

Route::get('/carts', 'CartController@view')->name('carts');
Route::get('/favourites', 'FavouriteController@view')->name('favourites');
Route::get('/success', function() {
    return view('/success');
})->name('success');
Route::get('/transactions', 'TransactionController@view')->name('transactions');


// APIS
Route::post('/carts', 'CartController@add')->name('add-cart');
Route::post('/carts/update', 'CartController@update')->name('update-cart');
Route::post('/favourites', 'FavouriteController@add')->name('add-favourite');
Route::post('/checkout', 'TransactionController@checkout')->name('checkout');