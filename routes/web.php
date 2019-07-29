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


Route::get('profile', 'ProfileController@show');
Route::get('profile/edit', 'ProfileController@edit');
Route::patch('profile', 'ProfileController@update');

Route::post('jobs', 'JobsController@store');
Route::get('jobs/create', 'JobsController@create');
Route::get('jobs/{job}/edit', 'JobsController@edit');
Route::get('jobs/{job}/{slug}', 'JobsController@show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
