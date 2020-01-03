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

Route::group(['middleware' => ['auth', 'verified']], function () {


Route::get('/profile', 'ProfileController@index');

});



// Route::get('/send-mail', function () {

//     Mail::to('newuser@example.com')->send(new SendTestEmail()); 

//     return 'A message has been sent to Mailtrap!';

// });


Auth::routes(['verify' => true]);

Route::get('/', 'PublicController@index');

Route::get('/tutors', 'TutorController@index');
Route::get('/students', 'StudentController@index');
