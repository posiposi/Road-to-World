<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Requests\UserRegisterRequest;
use App\Services\Image\S3Service;
use App\Services\UserService;
use Core\src\Bike\UseCase\GetUserBike\GetUserBike;
use Core\src\User\UseCase\GetUserId\GetUserId;
use Illuminate\View\View;

class UsersController extends Controller
{
    private $getUserIdUseCase;

    private $getUserBikeUseCase;

    public function __construct(
        User $user,
        S3Service $s3Service,
        GetUserId $getUserIdUseCase,
        GetUserBike $getUserBikeUseCase
    ) {
        $this->user = $user;
        $this->s3Service = $s3Service;
        $this->getUserIdUseCase = $getUserIdUseCase;
        $this->getUserBikeUseCase = $getUserBikeUseCase;
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
     */
    public function redirectMybikePage(): View
    {
        $userId = $this->getUserIdUseCase->execute();
        $bikeList = $this->getUserBikeUseCase->execute($userId);
        return view('bikes.mybike_index', compact('userId', 'bikeList'));
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
