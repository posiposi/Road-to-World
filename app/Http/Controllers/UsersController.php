<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Requests\UserRegisterRequest;

class UsersController extends Controller
{
    // コンストラクタインジェクション
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * ユーザアバターの登録
     *
     * @param Request $request 登録リクエスト
     * @return void
     */
    public function store(Request $request)
    {
        // アバター画像をDBとS3に登録する
        $this->user->registerUserAvatar($request);
        return back();
    }
    
    /**
     * ユーザページの表示
     *
     * @return void
     */
    public function index()
    {
        [$login_user, $bikes, $reservations] = $this->user->getUserPageInfo();

        return view('users.index', compact('login_user', 'bikes', 'reservations'));
    }
    
    /**
     * ユーザ情報変更画面の表示
     * 
     * @var object $login_user ログインユーザー
     * @return void
     */
    public function edit()
    {
        // ログインユーザーを取得する
        $login_user = Auth::user();
        return view('users.edit', compact('login_user'));
    }
    
    /**
     * ユーザーの情報を変更する
     *
     * @param UserRegisterRequest $request 情報変更リクエスト
     * @param integer $user_id ログインユーザーid
     * @return void
     */
    public function update(UserRegisterRequest $request, int $user_id)
    {
        // ログインユーザーの情報を更新する
        $this->user->updateUserInfo($request, $user_id);
        // ユーザーマイページへ画面変遷する
        return redirect('/users');
    }
}
