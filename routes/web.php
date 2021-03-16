<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'App\Http\Controllers\EventController@index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/events/{id}/{event}' , 'App\Http\Controllers\EventController@show')->name('events.show');
Route::get('user/profile', 'App\Http\Controllers\UserController@index');
Route::post('user/profile/create','App\Http\Controllers\UserController@store')->name('profile.create');
Route::post('users/profile/avatar' , 'App\Http\Controllers\UserController@avatar')->name('avatar');