<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::group(['prefix'=> 'user/', 'middleware' => ['role:user']], function () {
    Route::get('dashboard', 'UserController@index')->name('user');
    Route::get('survey/{id}', 'UserController@evaluate');

    Route::post('submit-feedback', 'UserController@submitFeedback')->name('submit.feedback');
    Route::get('thak-you', 'UserController@tankYou')->name('thankyou');
});

Route::group(['prefix'=> 'admin/', 'middleware' => ['role:superadministrator']], function () {
    Route::get('dashboard', 'AdminController@index')->name('admin');
    Route::get('calendar', 'AdminController@calendar')->name('calendar');
    Route::get('generate-certificate', 'AdminController@generate')->name('generate');
    Route::get('gallery', 'AdminController@gallery')->name('gallery');

    //evaluation
    Route::get('evaluation', 'AdminController@evaluation')->name('evaluation');
    Route::post('plus-gallery', 'AdminController@addGallery');
    Route::get('get-gallery', 'AdminController@getGallery');

    //fullcalender
    Route::post('fullcalenderAjax', 'AdminController@ajax');

    // survey
    Route::get('survey', 'AdminController@survey')->name('survey');
    Route::get('/make-survey/{id}', 'AdminController@makeSurvey');
    Route::post('/submit-survey', 'AdminController@submitSurvey')->name('submit.survey');
});
