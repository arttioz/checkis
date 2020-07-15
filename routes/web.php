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
Route::get('home', "ISController@index")->name('home');

Route::get('overview', "ISController@overview");

Route::get('contact', "ISController@contact");


Route::get('tracking', "ISController@tracking");
Auth::routes();

Route::get('tracking_detail/{hospcode}/{year}', "ISController@tracking_detail")->middleware('auth');

Route::get('check_error', "ISController@check_error")->middleware('auth');
Route::post('check_error/process', 'ISController@check_error_process')->name('check_error_process')->middleware('auth');


Route::get('check_duplicate', "ISController@check_duplicate")->middleware('auth');
Route::post('check_duplicate/process', 'ISController@check_duplicate_process')->name('check_duplicate_process')->middleware('auth');

Route::resource('user', 'UserController')->middleware('auth');


Route::get('is_import', 'ISController@is_import');
Route::get('is_rawdata', 'ISController@is_rawdata');



Route::get('logout', 'Auth\LoginController@logout');


Route::get('isdata', "ISController@testConnection");
Route::get('checkData/{month}/{year}', "ISController@checkData");

Route::get("/user-error", function(){
    return View::make("page.error");
});
