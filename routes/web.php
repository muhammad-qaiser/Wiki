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
use App\Articles;

Route::get('/', function () {
    return view('welcome')->with('articles', Articles::all());
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/createArticles' , [
    'uses' => 'ArticleController@create',
    'as' => 'articleCreate'
]);

Route::post('/saveArticle', [
    'uses'=> 'ArticleController@store',
    'as' => 'articleSave'
    ]);

Route::get('/editArticle/{id}',[
    'uses' => 'ArticleController@edit',
    'as' => 'articleEdit'
]);

Route::get('/deleteArticle/{id}',[
    'uses' => 'ArticleController@destroy',
    'as' => 'articleDelete'
]);

Route::get('/updateArticle/{id}',[
    'uses' => 'ArticleController@update',
    'as' => 'articleUpdate'
]);

Route::get('/article/{id}',[
    'uses' => 'ArticleController@show',
    'as' => 'articleShow'
]);

Route::get('/query/{id}',[
    'uses' => 'ArticleController@query',
    'as' => 'query'
]);


