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

Route::resource('questions', 'QuestionsController')->except('show');

Route::get('/questions/{slug}', 'QuestionsController@show')->name('questions.show');

//handles answers creation
Route::resource('questions.answers', 'AnswersController')->except(['index', 'create', 'show']);

//handles the acceptance of the best answer to be set by the creator of a post
Route::post('/answers/{answer}/accept', 'AcceptAnswerController')->name('answers.accept'); 

//route to favorite the question
Route::post('/questions/{question}/favorites', 'FavoritesController@store')->name('questions.favorite');

//route to delete remove the favourite question
Route::delete('/questions/{question}/favorites', 'FavoritesController@destroy')->name('questions.unfavorite');

//new route for voting question to realod the page and update the vote counts
Route::post('/questions/{question}/vote', 'VoteQuestionController');
// route for making voting controls work
Route::post('/answers/{answer}/vote', 'VoteAnswerController'); 