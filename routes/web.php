<?php

use App\Http\Controllers\TopPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BikesController;

// メインページ
Route::get('/', [TopPageController::class, 'index']);

// Full-Calendarテスト
// 前月、次月への変遷技術調査が完了するまでコメントアウト
// Route::get('/calendar', function(){
//     return view('calendar');
// });

// ユーザー登録
Route::controller(Auth\RegisterController::class)->prefix('signup')->group(function() {
    Route::get('/', 'showRegistrationForm')->name('signup.get');
    Route::post('/', 'register')->name('signup.post');
});

// ログイン
Route::controller(Auth\LoginController::class)->group(function() {
    Route::get('login', 'showLoginForm')->name('login');
    Route::post('login', 'login')->name('login.post');
    Route::get('logout', 'logout')->name('logout.get');
});

// 検索機能
Route::controller(SearchController::class)->prefix('search')->group(function() {
     // 検索画面表示
    Route::get('/', 'show')->name('search');
    // 検索結果表示
    Route::get('/index', 'index')->name('search.index');
});

// 貸出中自転車一覧表示
Route::controller(\BikesController::class)->prefix('bikes')->group(function() {
    Route::get('/', 'index')->name('bikes.index');
});

// サービスクラス呼び出し
Route::controller(\ServiceController::class)->prefix('service')->group(function() {
    // S3から画像取得
    Route::get('/show', 'show')->name('service.show');
});

// ログイン認証
Route::group(['middleware' => ['auth']], function ()
    {
        // 自転車関連
        Route::controller(\BikesController::class)->group(function() {
            // 自転車登録画面表示
            Route::get('bikeregister', 'show')->name('bikes.get');
            // 新規自転車登録
            Route::post('bikeregister', 'store')->name('bikes.store');
            // 自転車情報変更画面表示
            Route::get('bikes/{bike_id}/edit', 'edit')->name('bikes.edit');
            // 自転車情報変更
            Route::put('bikes/{id}/update', 'update')->name('bikes.update');
            // 自転車削除
            Route::delete('bikes/{id}/delete', 'destroy')->name('bikes.delete');
        });
        
        // 予約関連
        Route::controller(\ReservationController::class)->prefix('bikes')->group(function() {
            // 予約アクション
            Route::post('/{bikeId}', 'store')->name('bikes.reservation');
            // カレンダー表示
            Route::get('/{bikeId}/{week}/{now}/calendar', 'index')->name('bikes.calendar');
        });

        // ユーザー関連
        Route::controller(\UsersController::class)->prefix('users')->group(function() {
            // ユーザ情報表示
            Route::get('/', 'index')->name('users.index');
            // ユーザアバター登録
            Route::post('/', 'store')->name('users.store');
            // ユーザ情報変更画面表示
            Route::get('/edit', 'edit')->name('users.edit');
            // ユーザ情報変更
            Route::put('/{userId}/update', 'update')->name('users.update');
        });
        
        // チャット機能
        Route::controller(\CommentsController::class)->prefix('comments')->group(function() {
            // コメントルーム一覧表示
            Route::get('/{bikeId}/{lenderId}/index', 'index')->name('comments.index');
            // コメントルーム表示
            Route::get('/{bikeId}/{senderId}/{receiverId}/show', 'show')->name('comments.show');
            // コメント保存
            Route::post('/{bikeId}/{senderId}/{receiverId}/store', 'store')->name('comments.store');
            // コメント取得
            Route::get('/{bikeId}/{senderId}/{receiverId}/get', 'getSenderAndReceiverComment')->name('comments.get');
        });

        // 決済機能
        Route::controller(\PaymentsController::class)->group(function() {
            // 決済ボタン画面表示
            Route::get('payment/{time}/{price}/{bikeId}/{startTime}/{endTime}/index', 'index')->name('payment.index');
            // 決済処理
            Route::post('/{amount}/{bikeId}/{startTime}/{endTime}/payment', 'payment')->name('payment');
            // 決済完了ページ表示
            Route::get('/complete', 'complete')->name('complete');
        });
    });