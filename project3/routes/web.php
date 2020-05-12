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

Route::get('/restaurants/{restaurantSlug}/reviews/create', 'ReviewController@create');
Route::post('/restaurants/{restaurantSlug}/reviews', 'ReviewController@store');

//Route::resource('/restaurants/{restaurant}/reviews', 'ReviewController');
Route::get('/restaurants/{restaurantSlug}/reviews', 'ReviewController@index');
Route::get('/restaurants/{restaurantSlug}/reviews/{review}', 'ReviewController@show');

Route::get('/restaurants/{restaurantSlug}/reviews/{id}/edit', 'ReviewController@edit');
Route::put('/restaurants/{restaurantSlug}/reviews/{id}', 'ReviewController@update');

Route::get('/restaurants/{restaurantSlug}/reviews/{id}/delete', 'ReviewController@delete');
Route::delete('/restaurants/{restaurantSlug}/reviews/{id}', 'ReviewController@destroy');

Route::post('/restaurants/{restaurantSlug}/reviews/{review}/replies', 'ReplyController@store');
Route::get('/restaurants/{restaurantSlug}/reviews/{review}/replies/{reply}/delete', 'ReplyController@destroy');

Route::get('/favorites', 'FavoritesController@show');
Route::get('/favorites/{restaurantSlug}/add', 'FavoritesController@add');
Route::get('/favorites/{restaurantSlug}/destroy', 'FavoritesController@destroy');

Route::get('/search', 'RestaurantController@search');
