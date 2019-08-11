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

//Routes related to Job Questions
Route::get('jobs/{job}/{slug}/questions', 'JobQuestionsController@index');
Route::post('jobs/{job}/{slug}/questions', 'JobQuestionsController@store');

// Routes related to Jobs
Route::get('jobs', 'JobsController@index');
Route::get('jobs/create', 'JobsController@create');
Route::get('jobs/{job}/edit', 'JobsController@edit');
Route::get('jobs/{job}/{slug}', 'JobsController@show');
Route::post('jobs', 'JobsController@store');
Route::patch('jobs/{job}', 'JobsController@update');
Route::delete('jobs/{job}', 'JobsController@destroy');

// Routes related to Job Application
Route::post('jobs/{job}/{slug}/apply', 'JobApplicationController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
