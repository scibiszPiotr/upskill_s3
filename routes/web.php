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

Route::get('/s3/', function () {
    return view('welcome');
});


Route::get('/s3/form', '\App\Http\Controllers\Controller@form');
Route::get('/s3/list', '\App\Http\Controllers\Controller@getList');
