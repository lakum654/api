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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('posts', 'PostController');
Route::post('posts/favorite','PostController@addFavirote')->name('posts.favorite');
Route::post('add-like','PostController@addLike')->name('add.like');
Route::post('save-reply','CommentController@saveReply');
Route::resource('comments','CommentController');
Route::get('comments/delete/{id}','CommentController@destroy');
Route::get('comment-notification','PostController@notification');
Route::get('favirote','PostController@favirote');
Route::get('notification','UserController@index');
Route::post('notification/send', 'UserController@sendNotification');

