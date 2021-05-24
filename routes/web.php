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

Route::get('/', 'App\Http\Controllers\EventController@index')->name('home2');

Route::get('/events/create', 'App\Http\Controllers\EventController@create')->name('event.create');
Route::post('/events/create', 'App\Http\Controllers\EventController@store')->name('event.store');
Route::get('/events/my-event', 'App\Http\Controllers\EventController@myevent')->name('my.events');


Auth::routes();

Route::get('/events/{id}/edit', 'App\Http\Controllers\EventController@edit')->name('event.edit');
Route::post('/events/{id}/edit', 'App\Http\Controllers\EventController@update')->name('event.update');
Route::get('/events/{id}/delete', 'App\Http\Controllers\EventController@delete')->name('event.delete');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/events/{id}/{event}', 'App\Http\Controllers\EventController@show')->name('events.show');
Route::get('profile', 'App\Http\Controllers\UserController@index')->name('profile');


Route::post('user/profile/create', 'App\Http\Controllers\UserController@store')->name('profile.create');
Route::post('organizer/profile/create', 'App\Http\Controllers\UserController@store')->name('profile.create');

Route::post('users/profile/avatar', 'App\Http\Controllers\UserController@avatar')->name('avatar');
Route::view('organizer/register', 'auth.organizer-register')->name('organizer.register');
Route::post('organizer/register', 'App\Http\Controllers\OrganizerRegisterController@organizerRegister')
    ->name('org.register');
Route::post('register', 'App\Http\Controllers\Auth\RegisterController@create')->name('user.register');

Route::get('login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);

Route::get('login/facebook', [App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleFacebookCallback']);

Route::post('/participations/{id}', 'App\Http\Controllers\EventController@participate')->name('participate');
Route::get('events/participations', 'App\Http\Controllers\EventController@participant')->name('participant');
Route::get('/participants/{event_id}/{user_id}/delete', 'App\Http\Controllers\UserController@delete')->name('participant.delete');

Route::post('/add/{id}', 'App\Http\Controllers\FavouriteController@addEvent');
Route::post('/remove/{id}', 'App\Http\Controllers\FavouriteController@removeEvent');
Route::get('events/allevents', 'App\Http\Controllers\EventController@allEvents')->name('allevents');
Route::get('events/search', 'App\Http\Controllers\EventController@searchEvents');

Route::get('/category/{id}', 'App\Http\Controllers\CategoryController@index')->name('category.index');

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->middleware('admin')->name('dash.index');

Route::post('/comments/{event}', 'App\Http\Controllers\CommentController@store')->name('comments.store');

Route::get('/dashboard/users', 'App\Http\Controllers\UserController@getuser')->name('dash.show');
Route::get('/dashboard/categories', 'App\Http\Controllers\CategoryController@getcategory')->name('dash.show2');

Route::post('/commentReply/{comment}/{event}', 'App\Http\Controllers\CommentController@storeCommentReply')->name('comments.storeReply');
Route::post('/event/mail', 'App\Http\Controllers\EmailController@send')->name('mail');
Route::get('/showFromNotification/{id}/{event}/{notification}', 'App\Http\Controllers\EventController@showFromNotification')->name('events.showFromNotification');

Route::post('/categories/create', 'App\Http\Controllers\CategoryController@store')->name('category.store');
Route::post('/categories/{id}/edit', 'App\Http\Controllers\CategoryController@update')->name('category.update');
Route::get('/categories/{id}/delete', 'App\Http\Controllers\CategoryController@delete')->name('category.delete');

Route::post('/users/{id}/block', 'App\Http\Controllers\UserController@update')->name('user.block');
