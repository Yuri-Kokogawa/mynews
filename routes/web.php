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
Route::get('admin/profile/create','Admin\ProfileController@add');
Route::get('admin/profile/edit','Admin\ProfileController@edit');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// この設定したcreate.blade.phpのページに飛ぶ時にログイン画面にリダイレクトする、ログインできていればブラウザが普通に表示される
Route::group(['prefix' => 'admin'], function() {
    Route::get('news/create', 'Admin\NewsController@add')->middleware('auth');
});
