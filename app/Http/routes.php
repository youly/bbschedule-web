<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', 'HomeController@index');

Route::get('job/create', 'JobController@create');
Route::post('job/store', 'JobController@store');
Route::post('job/destroy/{id}', 'JobController@destroy');
Route::get('job/edit/{id}', 'JobController@edit');
Route::post('job/update/{id}', 'JobController@update');

Route::get('job/schedule/{id}', 'JobController@schedule');
Route::get('job/log/{schedule_id}', 'JobController@log');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
