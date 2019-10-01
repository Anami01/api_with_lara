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

Route::resource('/user','UserController')->middleware('session');
Route::get('/login','UserController@login');
Route::get('/logout','UserController@logout');
Route::post('/setSession','UserController@setSession');
Route::get('/test','UserController@testDatabase');
Route::get('/register','UserController@register');
Route::post('/add_user','UserController@add_user');