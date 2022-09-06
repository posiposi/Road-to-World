<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\{User, Bike, Reservation};
use App\Http\Requests\UserRegisterRequest;

class UsersController extends Controller
{
    /**
     * ユーザアバターの登録
     *
     * @param Request $request 登録リクエスト
     * @return void
     * @var object $user ログインユーザー
     * @var object $image 登録する画像
     * @var string $url 登録する画像のURLパス
     */
    public function store(Request $request, User $user)
    {
        // アバター画像をDBとS3に登録する
        $user->registerUserAvatar($request);
        return back();
    }
    
    /**
     * ユーザページの表示
     *
     * @return void
     * @var object $login_user ログインユーザー
     * @var object $bikes 登録中の全ての自転車
     * @var object $reservations ログインユーザの全予約
     */
    public function index()
    {
        $login_user = Auth::user();
        $bikes = Bike::all();
        $reservations = Reservation::where('user_id', $login_user->id)->get();

        return view('users.index', compact('login_user', 'bikes', 'reservations'));
    }
    
    /**
     * ユーザ情報変更画面の表示
     * @var object $login_user ログインユーザー
     * 
     * @return void
     */
    public function edit()
    {
        // ログインユーザーを取得する
        $login_user = Auth::user();
        return view('users.edit', compact('login_user'));
    }
    
    /**
     * ユーザ情報変更
     * 
     * @param int $id ログイン中ユーザのid
     * @return void
     * @var object $auth ログインユーザのレコード
     */
    public function update(UserRegisterRequest $request, int $id)
    {
        $auth = User::findOrFail($id);
        $form = $request->all();
        
        // フォームトークン削除
        unset($form['_token']);
        // レコードアップデート
        $auth->fill($form)->save();
        //パスワードハッシュ化
        $auth->fill(['password' => Hash::make($request->password)])->save();
        
        return redirect('/users');
    }
}
