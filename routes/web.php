<?php

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
Route::middleware(['session'])->group(function(){
	Route::get('','UserController@index');
	Route::resource('/user','UserController');
	Route::get('/change_password','UserController@change_password');
	Route::post('/change_pass','UserController@change_pass');
});
Route::post('/add_user','UserController@add_user');
Route::get('/test','UserController@testDatabase');
Route::get('/register','UserController@register');
Route::get('/login','UserController@login');
Route::get('/logout','UserController@logout');
Route::get('/add_city','UserController@add_city');
Route::get('/get_state_data/{id}','UserController@get_state_data');
Route::get('/check_email','UserController@check_email');
Route::get('/get_city_data/{state}/{country}','UserController@get_city_data');
Route::post('add_city_data','UserController@add_city_data');
Route::post('/setSession','UserController@setSession');