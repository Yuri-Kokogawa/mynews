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


// 10 ControllerとViewが連携できるようにしようのカリキュラム
Route::get('admin/news/create','Admin\NewsController@add');
// 10 ControllerとViewが連携できるようにしようの課題
Route::get('admin/profile/create','Admin\ProfileController@add');
Route::get('admin/profile/edit','Admin\ProfileController@edit');


// 課題４
Route::get('XXX','Admin/AAAcontroller@bbb');

// 課題５
Route::get('admin/profile/create','Admin\ProfileController@add')->middleware('auth');
Route::get('admin/profile/edit','Admin\ProfileController@edit')->middleware('auth');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// この設定したcreate.blade.phpのページに飛ぶ時にログイン画面にリダイレクトする、ログインできていればブラウザが普通に表示される
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
     Route::get('news/create', 'Admin\NewsController@add');
     Route::post('news/create', 'Admin\NewsController@create'); # 追記
     Route::get('news', 'Admin\NewsController@index'); // 追記
//  PHP/Laravel 13 ニュース投稿画面を作成しよう 課題3
     Route::post('profile/create','Admin\ProfileController@create');
//  PHP/Laravel 13 ニュース投稿画面を作成しよう 課題6
     Route::post('profile/edit','Admin\ProfileController@update');
     
     Route::get('news/edit','Admin\NewsController@edit') ;// 追記
     Route::post('news/edit','Admin\NewsController@update'); // 追記
      Route::get('news/delete', 'Admin\NewsController@delete');
});

