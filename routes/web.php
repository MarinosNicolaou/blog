<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('posts', 'PostsController')->except('show');

Route::get('/posts/{slug}', 'PostsController@show')->name('posts.show');

//handles comments creation
Route::resource('posts.comments', 'CommentsController')->except(['index', 'create', 'show']);

//
Route::post('/comments/{comment}/comment', 'AcceptCommentController')->name('comments.comment'); 
