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
Route::get('/events/create', 'App\Http\Controllers\EventController@create')->name('event.create');
Route::post('/events/create', 'App\Http\Controllers\EventController@store')->name('event.store');
Route::get('/events/my-event','App\Http\Controllers\EventController@myevent')->name('my.events');

Route::post('/events/picture','App\Http\Controllers\EventController@mypicture')->name('picture');

Auth::routes();

Route::get('/events/{id}/edit' , 'App\Http\Controllers\EventController@edit')->name('event.edit');
Route::post('/events/{id}/edit' , 'App\Http\Controllers\EventController@update')->name('event.update');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/events/{id}/{event}' , 'App\Http\Controllers\EventController@show')->name('events.show');
Route::get('user/profile', 'App\Http\Controllers\UserController@index')->name('profile');
Route::get('organizer/profile', 'App\Http\Controllers\UserController@index')->name('profile');

Route::post('user/profile/create','App\Http\Controllers\UserController@store')->name('profile.create');
Route::post('organizer/profile/create','App\Http\Controllers\UserController@store')->name('profile.create');

Route::post('users/profile/avatar' , 'App\Http\Controllers\UserController@avatar')->name('avatar');
Route::view('organizer/register','auth.organizer-register')->name('organizer.register');
Route::post('organizer/register' , 'App\Http\Controllers\OrganizerRegisterController@organizerRegister')
->name('org.register');