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

Route::get('/', function () {
	return view('welcome');
});
Route::middleware(['session'])->group(function(){
	Route::resource('/user','UserController');
	Route::get('/test','UserController@testDatabase');
	Route::post('/add_user','UserController@add_user');
	Route::get('/change_password','UserController@change_password');
	Route::post('/change_pass','UserController@change_pass');
});
Route::get('/register','UserController@register');
Route::get('/login','UserController@login');
Route::get('/logout','UserController@logout');
Route::post('/setSession','UserController@setSession');