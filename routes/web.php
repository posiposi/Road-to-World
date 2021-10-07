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
    //自転車登録
        Route::get('bikeregister', 'BikesController@show')->name('bikes.get'); //自転車登録画面へのルーティング
        Route::post('bikeregister', 'BikesController@store')->name('bikes.store'); //新規自転車の登録
    //自転車一覧
        Route::get('bikes', 'BikesController@index')->name('bikes.index'); //貸出中自転車一覧へのルーティング
    //自転車予約
        Route::post('bikes/{id}', 'ReservationController@store')->name('bikes.reservation'); //自転車予約アクションへのルーティング
    //ユーザ情報画面
        Route::get('users', 'UsersController@index')->name('users.index');
    //ユーザアバター登録
        Route::post('users', 'UsersController@store')->name('users.store');
    }
);