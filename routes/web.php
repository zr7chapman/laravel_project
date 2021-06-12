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
// ブログ一覧画面を表示
Route::get('/', 'BlogController@showList')->name('blogs');
// ブログ詳細画面を表示
Route::get('/blog/{id}', 'BlogController@showDetail')->name('show');
    

Route::get('/messages', 'MessagesController@index');

Route::post('/messages', 'MessagesController@create');
Auth::routes();

Route::get('/calendar_page','CalendarController@show');

