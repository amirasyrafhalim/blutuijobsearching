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
    return redirect('/jobs');
});

// Routes related to users
Route::get('users/{user}', 'UsersController@show');

// Routes related to messages
Route::get('messages', 'MessagesController@index');
Route::get('messages/{receiver}', 'MessagesController@show');
Route::post('messages/{receiver}', 'MessagesController@store');
Route::delete('messages/{user}/{message}', 'MessagesController@delete');

// Routes related to profile
Route::get('profile', 'ProfileController@show');
Route::get('profile/edit', 'ProfileController@edit');
Route::patch('profile', 'ProfileController@update');

// Routes related to Hiring Applicant
Route::get('jobs/{job}/applicant/{applicant}', 'HiringApplicantController@show');
Route::post('jobs/{job}/applicant/{applicant}', 'HiringApplicantController@store');

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
Route::get('jobs/{job}/{slug}/applications', 'JobApplicationController@index');
Route::get('jobs/{job}/{slug}/apply', 'JobApplicationController@create');
Route::post('jobs/{job}/{slug}/apply', 'JobApplicationController@store');

// Routes related to applied and advertised job
Route::get('applied-jobs', 'AppliedJobsController@index');
Route::get('advertised-jobs', 'AdvertisedJobsController@index');

//Routes related to user documents
Route::get('profile/document', 'UserDocumentsController@create');
Route::post('profile/document', 'UserDocumentsController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
