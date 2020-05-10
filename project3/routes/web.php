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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/restaurants', 'RestaurantController@index');
Route::get('/restaurants/{restaurantSlug}', 'RestaurantController@show');
//Route::resource('/restaurants/{restaurant}/reviews', 'ReviewController');
Route::get('/restaurants/{restaurantSlug}/reviews', 'ReviewController@index');
Route::get('/restaurants/{restaurantSlug}/reviews/{review}', 'ReviewController@show');

Route::get('/restaurants/{restaurantSlug}/reviews/create', 'ReviewController@create');
Route::post('/restaurants/{restaurantSlug}/reviews/store', 'ReviewController@store');

Route::get('/restaurants/{restaurantSlug}/reviews/{id}/edit', 'ReviewController@edit');
Route::put('/restaurants/{restaurantSlug}/reviews/{id}/update', 'ReviewController@update');

Route::post('/restaurants/{restaurantSlug}/reviews/{review}/replies', 'ReplyController@store');
