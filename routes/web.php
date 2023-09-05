<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TopPageController;
use App\Http\Controllers\BikesController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Message\SendMessageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Message\RedirectMessageRoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Message\GetMessagesController;

// メインページ
Route::get('/', [TopPageController::class, 'index'])->name('home');

// ユーザー登録
Route::prefix('signup')->group(function () {
    Route::get('/', [RegisterController::class, 'showRegistrationForm'])->name('signup.get');
    Route::post('/', [RegisterController::class, 'register'])->name('signup.post');
});

// ログイン
Route::prefix('login')->group(function () {
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/', [LoginController::class, 'login'])->name('login.post');
});

// ログアウト
Route::get('logout', [LoginController::class, 'logout'])->name('logout.get');

// 検索機能
Route::prefix('search')->group(function () {
    // 検索画面表示
    Route::get('/', [SearchController::class, 'show'])->name('search');
    // 検索結果表示
    Route::get('/index', [SearchController::class, 'index'])->name('search.index');
});

// 貸出中自転車一覧表示
Route::prefix('bikes')->group(function () {
    Route::get('/', [BikesController::class, 'index'])->name('bikes.index');
});

// サービスクラス呼び出し
Route::prefix('service')->group(function () {
    // S3から画像取得
    Route::get('/show', [ServiceController::class, 'show'])->name('service.show');
    // メインページ内のテキスト取得
    Route::get('/getText', [ServiceController::class, 'getMainPageText'])->name('service.getText');
});

// ログイン認証
Route::group(['middleware' => ['auth']], function () {
    // 自転車情報関連
    Route::prefix('bikes')->group(function () {
        // 自転車情報変更画面表示
        Route::get('/{bikeId}/edit', [BikesController::class, 'edit'])->name('bikes.edit');
        // 自転車情報変更
        Route::put('/{id}/update', [BikesController::class, 'update'])->name('bikes.update');
        // 自転車削除
        Route::get('/{bikeId}/delete', [BikesController::class, 'destroy'])->name('bikes.delete');
        Route::delete('/{bikeId}/delete', [BikesController::class, 'destroy'])->name('bikes.delete');
        // 予約アクション
        Route::post('/{bikeId}', [ReservationController::class, 'store'])->name('bikes.reservation');
        // カレンダー表示
        Route::get('/{bikeId}/{week}/{now}/calendar', [ReservationController::class, 'index'])->name('bikes.calendar');
    });

    // 自転車登録関連
    Route::prefix('bikeregister')->group(function () {
        // 自転車登録画面表示
        Route::get('/', [BikesController::class, 'show'])->name('bikes.get');
        // 新規自転車登録
        Route::post('/', [BikesController::class, 'store'])->name('bikes.store');
    });

    // ユーザー関連
    Route::prefix('users')->group(function () {
        // ユーザ情報表示
        Route::get('/', [UsersController::class, 'index'])->name('users.index');
        // ユーザアバター登録
        Route::post('/', [UsersController::class, 'store'])->name('users.store');
        // ユーザ情報変更画面表示
        Route::get('/edit', [UsersController::class, 'edit'])->name('users.edit');
        // ユーザ情報変更
        Route::put('/update', [UsersController::class, 'update'])->name('users.update');
        // マイバイク画面表示
        Route::get('mybikes/index', [UsersController::class, 'redirectMybikePage'])->name('mybike.index');
    });

    // チャット機能
    Route::prefix('comments/{bikeId}')->group(function () {
        // コメントルーム一覧表示
        Route::get('/{lenderId}/index', [CommentsController::class, 'index'])->name('comments.index');
        // コメントルーム表示
        Route::get('/{senderId}/{receiverId}/show', [CommentsController::class, 'show'])->name('comments.show');
        // コメント保存
        Route::post('/{senderId}/{receiverId}/store', [CommentsController::class, 'store'])->name('comments.store');
        // コメント取得
        Route::get('/{senderId}/{receiverId}/get', [CommentsController::class, 'getSenderAndReceiverComment'])->name('comments.get');
    });

    // 決済機能
    // 決済ボタン画面表示
    Route::get('payment/{time}/{price}/{bikeId}/{startTime}/{endTime}/index', [PaymentsController::class, 'index'])->name('payment.index');
    // 決済処理
    Route::post('/{amount}/{bikeId}/{startTime}/{endTime}/payment', [PaymentsController::class, 'payment'])->name('payment');
    // 決済完了ページ表示
    Route::get('/complete', [PaymentsController::class, 'complete'])->name('complete');

    // メッセージテストルームへリダイレクト
    Route::get('messages/room', RedirectMessageRoomController::class);
    // 既存メッセージ取得
    Route::get('messages/{loginUserId}/{anotherUserId}/{bikeId}/get', GetMessagesController::class);
    // メッセージイベント発行
    Route::post('message/{loginUserId}/{anotherUserId}/{bikeId}/post', SendMessageController::class);
});
