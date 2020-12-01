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



// 課題４
Route::get('XXX','Admin/AAAcontroller@bbb');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// この設定したcreate.blade.phpのページに飛ぶ時にログイン画面にリダイレクトする、ログインできていればブラウザが普通に表示される
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
     Route::get('news/create', 'Admin\NewsController@add');
     Route::post('news/create', 'Admin\NewsController@create'); # 追記
     Route::get('news', 'Admin\NewsController@index'); // 追記
//  PHP/Laravel 13 ニュース投稿画面を作成しよう 課題3
     Route::post('profile/create','Admin\ProfileController@create');
     Route::get('profile/create','Admin\ProfileController@add');

     
     Route::get('news/edit','Admin\NewsController@edit') ;// 追記
     Route::post('news/edit','Admin\NewsController@update'); // 追記
     Route::get('news/delete', 'Admin\NewsController@delete');
      
    Route::get('profile', 'Admin\ProfileController@index'); 
    Route::post('profile/edit','Admin\ProfileController@update'); 
    Route::get('profile/edit', 'Admin\ProfileController@edit');
     Route::get('profile/delete', 'Admin\ProfileController@delete');
});

