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

Route::get('','HomeController@getIndex');
Route::get('login','HomeController@getLogin');
Route::get('logout','HomeController@getLogout');
Route::post('login','HomeController@postLogin');
Route::get('changepassword','HomeController@getChangepassword');
Route::post('changepassword','HomeController@postChangepassword');

Route::controller('project','ProjectController');

Route::controller('user','UserController');
