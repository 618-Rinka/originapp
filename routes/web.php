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

use App\Http\Controllers\TopicController;

Route::get('/', 'TopicController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/users/1', function () {
    //return view('users.show');
//});

Route::get('/users/{id}', 'UserController@show');

Route::middleware('auth')->group(function(){
    Route::get('me','UserController@edit');
    Route::post('me','UserController@update')->name('users.update');
});

Route::prefix('topics')->as('topics.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('create', 'TopicController@create')->name('create');
        Route::post('store', 'TopicController@store')->name('store');
        Route::post('{topic}/delete', 'TopicController@delete')->name('delete');
        Route::post('{topic}/reply', 'TopicController@reply')->name('reply'); 
    });
        Route::get('{topic}', 'TopicController@show')->name('show');
});

Route::middleware('auth')->prefix('likes')->as('likes.')->group(function () {
    Route::get('/', 'LikeController@index')->name('index');
    Route::post('topic/{topic}', 'LikeController@add')->name('add');
    Route::post('topic/{topic}/remove', 'LikeController@remove')->name('remove');
});

Route::middleware('auth')->prefix('likes')->as('likes.')->group(function () {
    Route::get('/', 'LikeController@indexReply')->name('indexReply');
    Route::post('reply/{reply}', 'LikeController@addReply')->name('addReply');
    Route::post('reply/{reply}/remove', 'LikeController@removeReply')->name('removeReply');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//入力
Route::get('/contact', 'ContactController@index')->name('index');
//確認
Route::post('/contact/confirm', 'ContactController@confirm')->name('contact.confirm');
//送信完了
Route::post('/contact/thanks', 'ContactController@send')->name('contact.send');

Route::resource('topics','TopicController',['only'=>['index','create','store']]);

Route::get('/topics','TopicController@indexsearch');