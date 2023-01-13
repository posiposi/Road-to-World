<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Requests\UserRegisterRequest;
use App\Services\Image\S3Service;
use App\Services\UserService;

class UsersController extends Controller
{
    // コンストラクタインジェクション
    public function __construct(User $user, S3Service $s3Service)
    {
        $this->user = $user;
        $this->s3Service = $s3Service;
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
     * マイページの表示
     *
     * @return void
     */
    public function index()
    {
        // マイページ内に表示するログインユーザーの各種情報
        [$login_user, $bikes, $reservations] = $this->user->getUserPageInfo();
        // アバターNoImage画像
        $avatar_noimage = $this->s3Service->getAvatarNoImage();

        return view('users.index', compact('login_user', 'bikes', 'reservations', 'avatar_noimage'));
    }
    
    /**
     * 会員情報変更画面の表示
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
     * マイバイクページに画面遷移する
     *
     * @param integer $userId ログインユーザーID
     * @param object $userBikes ログインユーザーが所有する自転車
     * @return void
     */
    public function redirectMybikePage()
    {
        $user_id = UserService::getLoginUserId();
        $user_bikes = UserService::getUserBikes($user_id);
        return view('bikes.mybike_index', compact('user_id', 'user_bikes'));
    }

    /**
     * ユーザーの情報を変更する
     *
     * @param UserRegisterRequest $request 情報変更リクエスト
     * @param integer $user_id ログインユーザーid
     * @return void
     */
    public function update(UserRegisterRequest $request)
    {
        // ログインユーザーの情報を更新する
        $this->user->updateUserInfo($request);
        // ユーザーマイページへ画面変遷する
        return redirect('/users');
    }
}
