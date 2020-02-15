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

// Auth::routes();

Route::get('/', 'HomeController@index');
Route::post('/home/login', 'HomeController@login');
Route::post('/dashboard')->middleware('auth');
Route::get('/dashboard','DashboardController@index')->middleware('auth');
Route::post('/profile')->middleware('auth');
Route::get('/profile','ProfileController@index')->middleware('auth');
Route::post('/logout','HomeController@logout');
Route::post('/field')->middleware('auth');
Route::get('/field','FieldController@index')->middleware('auth');
Route::post('/profile/level')->middleware('auth');
Route::get('/profile/level','ProfileController@level')->middleware('auth');
Route::post('/field/create')->middleware('auth');
Route::get('/field/create','FieldController@create')->middleware('auth');
Route::get('/field/save','FieldController@save')->middleware('auth');
Route::post('/field/save','FieldController@save')->middleware('auth');
Route::get('/call/refresh','CallController@refresh')->middleware('auth');
Route::post('/call/refresh','CallController@refresh')->middleware('auth');
Route::get('/call/acept','CallController@acept')->middleware('auth');
Route::post('/call/acept','CallController@acept')->middleware('auth');
Route::get('/field/delete','FieldController@delete')->middleware('auth');
Route::post('/field/delete','FieldController@delete')->middleware('auth');
Route::get('/call','CallController@index')->middleware('auth');
Route::post('/call','CallController@index')->middleware('auth');
Route::get('/call/call','CallController@call')->middleware('auth');
Route::post('/call/call','CallController@call')->middleware('auth');