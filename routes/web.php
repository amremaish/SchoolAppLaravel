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

// login 
Route::post('/login', 'LoginController@login');
Route::get('/login', 'LoginController@login');
Route::post('/signup', 'SignUpController@SignUp');
Route::get('/', 'LoginController@login');

// home
Route::get('/logout', 'HomeController@logout');
Route::get('/material', 'HomeController@getMaterials');
Route::get('/exams', 'HomeController@getExams');
Route::get('/exams/{id}', 'HomeController@getExamDetails');
Route::get('/mat_requests', 'HomeController@getMaterialRequests');
Route::get('/profile', 'HomeController@Profile');
Route::get('/chat', 'ChatController@loadAllContacts');