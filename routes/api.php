<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::get('/user', 'AuthController@user');
Route::post('/logout', 'AuthController@logout');


Route::group(['prefix' => 'productos'], function () {
	Route::post('/', 'ProductoController@store')->middleware('auth:api');
	Route::get('/', 'ProductoController@index')->middleware('auth:api');
	Route::get('/{producto}', 'ProductoController@show')->middleware('auth:api');
	Route::patch('/{producto}', 'ProductoController@update')->middleware('auth:api');
	Route::delete('/{producto}', 'ProductoController@destroy')->middleware('auth:api');
});