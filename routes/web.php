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

//ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

//ログイン
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

//ログイン認証
Route::group(['middleware' => ['auth']], function ()
    {
    //自転車関連
        Route::get('bikeregister', 'BikesController@show')->name('bikes.get'); //自転車登録画面表示
        Route::post('bikeregister', 'BikesController@store')->name('bikes.store'); //新規自転車登録
        Route::get('bikes', 'BikesController@index')->name('bikes.index'); //貸出中自転車一覧表示
        Route::get('bikes/{id}/edit', 'BikesController@edit')->name('bikes.edit'); //自転車情報変更画面表示
        Route::post('bikes/{id}', 'ReservationController@store')->name('bikes.reservation'); //自転車予約アクション
        Route::put('bikes/{id}/update', 'BikesController@update')->name('bikes.update'); //自転車情報変更
        Route::delete('bikes/{id}/delete', 'BikesController@destroy')->name('bikes.delete'); //自転車削除
        
    //ユーザ関連
        Route::get('users', 'UsersController@index')->name('users.index'); //ユーザ情報表示
        Route::post('users', 'UsersController@store')->name('users.store'); //ユーザアバター登録
        Route::get('users/{id}/edit', 'UsersController@edit')->name('users.edit'); //ユーザ情報変更画面表示
        Route::put('users/{id}/update', 'UsersController@update')->name('users.update'); //ユーザ情報変更
        
    //チャット機能
        Route::get('comments/{id}/index', 'CommentsController@index')->name('comments.index'); //コメント一覧表示
        Route::post('comments/{id}/store', 'CommentsController@store')->name('comments.store'); //コメント保存
    });