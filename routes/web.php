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

Route::get('', "ISController@index");
Route::get('home', "ISController@index");
Route::get('contact', "ISController@contact");

Route::get('check_error', "ISController@check_error");
Route::get('check_duplicate', "ISController@check_duplicate");

Route::get('isdata', "ISController@testConnection");
Route::get('checkData/{month}/{year}', "ISController@checkData");






