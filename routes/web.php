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

Route::get('/', 'InterviewController@index');
Route::post('/', 'InterviewController@homePost');

Route::get('/contact', 'InterviewController@contact');
Route::post('/contact', 'InterviewController@contactPost');

Route::get('/login', 'InterviewController@login');
Route::post('/login', 'InterviewController@loginPost');

Route::get('/logout', 'InterviewController@logout');

Route::get('/admin', 'InterviewController@controlPanel')->middleware('login');
Route::post('/admin', 'InterviewController@controlPanelPost')->middleware('login');
