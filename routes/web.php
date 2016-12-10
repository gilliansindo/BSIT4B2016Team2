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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('home', 'HomeController@index');
Route::post('home/post','HomeController@addPost');
Route::post('home/comment','HomeController@addComment');
Route::get('settings','SettingsController@index');
Route::patch('settings','SettingsController@update');
Route::get('profile/{id}','ProfileController@index')->where('id','[0-9]+');
Route::get('{id}/edit','HomeController@editPost')->where('id','[0-9]+')->middleware('auth');
Route::patch('{id}/edit','HomeController@updatePost');
// Route::get('comment/{id}/edit','HomeController@editComment')->where('id','[0-9]+')->middleware('auth');
// Route::patch('comment/{id}/edit','HomeController@updateComment');