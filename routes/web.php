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

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BikesController;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
    return view('welcome');
});

//ユーザ登録
Route::controller(Auth\RegisterController::class)->prefix('signup')->group(function() {
    Route::get('/', 'showRegistrationForm')->name('signup.get');
    Route::post('/', 'register')->name('signup.post');
});

//ログイン
Route::controller(Auth\LoginController::class)->group(function() {
    Route::get('login', 'showLoginForm')->name('login');
    Route::post('login', 'login')->name('login.post');
    Route::get('logout', 'logout')->name('logout.get');
});

//検索機能
Route::controller(\SearchController::class)->prefix('search')->group(function() {
    Route::get('/', 'show')->name('search'); //検索画面表示
    Route::get('/index', 'index')->name('search.index'); //検索結果表示
    Route::get('/name', 'name')->name('search.name'); //名称検索画面
    Route::get('/brand', 'brand')->name('search.brand'); //ブランド検索画面
});

//貸出中自転車一覧表示
Route::controller(\BikesController::class)->prefix('bikes')->group(function() {
    Route::get('/', 'index')->name('bikes.index');
});

//ログイン認証
Route::group(['middleware' => ['auth']], function ()
    {
        //自転車関連
        Route::controller(\BikesController::class)->group(function() {
            Route::get('bikeregister', 'show')->name('bikes.get'); //自転車登録画面表示
            Route::post('bikeregister', 'store')->name('bikes.store'); //新規自転車登録
            Route::get('bikes/{id}/edit', 'edit')->name('bikes.edit'); //自転車情報変更画面表示
            Route::put('bikes/{id}/update', 'update')->name('bikes.update'); //自転車情報変更
            Route::delete('bikes/{id}/delete', 'destroy')->name('bikes.delete'); //自転車削除
        });
        
        //予約関連
        Route::controller(\ReservationController::class)->prefix('bikes')->group(function() {
            Route::post('/{id}', 'store')->name('bikes.reservation'); //予約アクション
            Route::get('/{bikeId}/{week}/{now}/calendar', 'index')->name('bikes.calendar'); //カレンダー表示
        });

        //ユーザ関連
        Route::controller(\UsersController::class)->prefix('users')->group(function() {
            Route::get('/', 'index')->name('users.index'); //ユーザ情報表示
            Route::post('/', 'store')->name('users.store'); //ユーザアバター登録
            Route::get('/{id}/edit', 'edit')->name('users.edit'); //ユーザ情報変更画面表示
            Route::put('/{id}/update', 'update')->name('users.update'); //ユーザ情報変更
        });
        
        //チャット機能
        Route::controller(\CommentsController::class)->prefix('comments')->group(function() {
            Route::get('/{bikeId}/{lenderId}/index', 'index')->name('comments.index'); //コメントルーム一覧表示
            Route::get('/{bikeId}/{senderId}/{receiverId}/show', 'show')->name('comments.show'); //コメントルーム表示
            Route::post('/{bikeId}/{recieverId}/store', 'store')->name('comments.store'); //コメント保存
        });

        //決済機能
        Route::controller(\PaymentsController::class)->group(function() {
            Route::get('payment/{time}/{price}/{bikeId}/{startTime}/{endTime}/index', 'index')->name('payment.index'); // 決済ボタンを表示するページ
            Route::post('/{amount}/{bikeId}/{startTime}/{endTime}/payment', 'payment')->name('payment'); // Stripeの処理
            Route::get('/complete', 'complete')->name('complete'); // 決済完了ページ
        });
    });