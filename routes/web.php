<?php

use Illuminate\Support\Facades\Mail;
use App\Mail\ProfileCompleted;

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



Route::group(['middleware' => ['auth', 'verified']], function () {



Route::get('/tutors/create', 'TutorController@create');
Route::get('/tutors/{tutor_id}', 'TutorController@show');
Route::put('/tutors', 'TutorController@update');
Route::post('/tutors', 'TutorController@store');
Route::get('/tutors', 'TutorController@index');

Route::get('/students/create', 'StudentController@create');
Route::get('/students/{student_id}', 'StudentController@show');
Route::put('/students', 'StudentController@update');
Route::post('/students', 'StudentController@store');
Route::get('/students', 'StudentController@index');

Route::get('/connects/requests', 'ConnectController@requests');
Route::delete('/connects/{request_to}', 'ConnectController@cancel');
Route::post('/connects/{request_to}', 'ConnectController@connect');
Route::get('/connections', 'ConnectController@connections');

Route::get('/profiles', 'ProfileController@index');
Route::put('/profiles/{user_id}/disapprove', 'ProfileController@disapprove');
Route::put('/profiles/{user_id}/approve', 'ProfileController@approve');
Route::get('/profile', 'ProfileController@show');

});



Route::get('/send-mail', function () {

    Mail::to('newuser@example.com')->send(new ProfileCompleted()); 

    return 'A message has been sent to Mailtrap!';

});


Auth::routes(['verify' => true]);

Route::get('/about', 'PublicController@about');
Route::get('/terms-of-use', 'PublicController@termsOfUse');
Route::post('/contact', 'PublicController@sendContact');
Route::get('/contact', 'PublicController@contact');
Route::get('/', 'PublicController@home');




