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
Route::post('posts/comments-update','CommentController@update');
Route::resource('comments','CommentController');
Route::get('posts/comments/delete/{id}','CommentController@destroy');
Route::get('comment-notification','PostController@notification');
Route::get('favirote','PostController@favirote');
Route::get('notification','UserController@index');
Route::post('notification/send', 'UserController@sendNotification');



// Route for Relationships
$path = 'Relationship';
Route::get('products',$path."\ProductController@index");
Route::post('getProduct',$path."\ProductController@getProduct");
Route::post('getPrice',$path."\ProductController@getPrice");
Route::post('orderSave',$path."\ProductController@orderSave");
Route::get('orders',$path."\ProductController@getOrders");


Route::get('oneToManyPholymorphic','NewsController@index');
Route::post('oneToManyPholymorphic/store','NewsController@store')->name('oneToManyPholymorphic.store');
Route::post('oneToManyPholymorphic/article/comment','NewsController@articleComment')->name('comment.article');
Route::post('oneToManyPholymorphic/news/comment','NewsController@newsComment')->name('comment.news');
Route::get('oneToManyPholymorphic/news/{id}','NewsController@news');
Route::get('oneToManyPholymorphic/article/{id}','NewsController@article');


Route::get('attendance','PmsController@index')->middleware('auth');
Route::any('attendance/in','PmsController@in');
Route::any('attendance/out/{workingHours}','PmsController@out');
Route::any('attendance/startWork/{seconds}','PmsController@startWork');
Route::get('attendance/report','PmsController@report');
Route::get('attendance/getData','PmsController@getData');

Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');