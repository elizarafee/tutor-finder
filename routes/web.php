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

Route::group(['middleware' => ['auth', 'verified', 'admin']], function () {
    Route::get('/profiles/review', 'ProfileController@review');
    Route::put('/profiles/{user_id}/disapprove', 'ProfileController@disapprove');
    Route::put('/profiles/{user_id}/approve', 'ProfileController@approve');
});

Route::group(['middleware' => ['auth', 'verified', 'tutor']], function () {
    Route::get('/tutors/create', 'TutorController@create');
    Route::get('/tutor/edit', 'TutorController@edit');
    Route::put('/tutors', 'TutorController@update');
    Route::post('/tutors', 'TutorController@store');
});

Route::group(['middleware' => ['auth', 'verified', 'student']], function () {
    Route::get('/students/create', 'StudentController@create');
    Route::get('/student/edit', 'StudentController@edit');
    Route::put('/students', 'StudentController@update');
    Route::post('/students', 'StudentController@store');
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/connects/requests', 'ConnectController@requests');
    Route::delete('/connects/{user_id}', 'ConnectController@cancel');
    Route::post('/connects/{user_id}', 'ConnectController@connect');
    Route::put('/connects/{user_id}/disconnect', 'ConnectController@disconnect');
    Route::put('/connects/{user_id}/accept', 'ConnectController@accept');
    Route::put('/connects/{user_id}/reject', 'ConnectController@reject');
    Route::get('/connections', 'ConnectController@connections');

    Route::put('/profile/activate', 'ProfileController@activate');
    Route::put('/profile/deactivate', 'ProfileController@deactivate');
    Route::get('/profile', 'ProfileController@show');

    Route::get('/tutors/{tutor_id}', 'TutorController@show');
    Route::get('/tutors', 'TutorController@index');

    Route::any('/search/students', 'StudentController@search');
    Route::get('/students/{student_id}', 'StudentController@show');
    Route::get('/students', 'StudentController@index');
});


Auth::routes(['verify' => true]);

Route::get('/about', 'PublicController@about');
Route::get('/terms-of-use', 'PublicController@termsOfUse');
Route::post('/contact', 'PublicController@sendContact');
Route::get('/contact', 'PublicController@contact');
Route::get('/', 'PublicController@home');
