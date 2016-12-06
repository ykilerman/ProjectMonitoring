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
Route::get('menu/notif','HomeController@getMenuNotif');
Route::get('notification','HomeController@getNotification');

Route::controller('project','ProjectController');
Route::controller('api','APIController');
Route::controller('user','UserController');
Route::controller('report','ReportController');
Route::controller('message','MessageController');
Route::controller('question','QuestionController');
Route::controller('answer','AnswerController');
