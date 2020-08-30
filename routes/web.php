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

Route::get('/access', 'InterviewController@sitelogin');
Route::post('/access', 'InterviewController@siteloginPost');

Route::get('/', 'InterviewController@index')->middleware('siteAccess');
Route::post('/', 'InterviewController@homePost')->middleware('siteAccess');

Route::get('/contact', 'InterviewController@contact')->middleware('siteAccess');
Route::post('/contact', 'InterviewController@contactPost')->middleware('siteAccess');

Route::get('/login', 'InterviewController@login')->middleware('siteAccess');
Route::post('/login', 'InterviewController@loginPost')->middleware('siteAccess');

Route::get('/logout', 'InterviewController@logout')->middleware('siteAccess');

Route::get('/admin', 'InterviewController@controlPanel')->middleware('login', 'siteAccess');
Route::post('/admin', 'InterviewController@controlPanelPost')->middleware('login', 'siteAccess');
