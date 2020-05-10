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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/restaurants', 'RestaurantController@index');
Route::get('/restaurants/{restaurant}', 'RestaurantController@show');

Route::get('/restaurants/{restaurant}/reviews', 'ReviewController@index');
Route::get('/restaurants/{restaurant}/reviews/{review}', 'ReviewController@show');

Route::post('/restaurants/{restaurant}/reviews/{review}/replies', 'ReplyController@store');
