<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Bike;
use Storage;
use App\Reservation;
use App\Http\Requests\UserRegisterRequest;

class UsersController extends Controller
{
    /**
     * ユーザアバターの登録
     *
     * @param Request $request 登録リクエスト
     * @return void
     * @var object $user ログインユーザ
     * @var object $image 登録する画像
     * @var string $url 登録する画像のURLパス

     */
    public function store(Request $request)
    {
        $user = Auth::user();
        //s3アップロード開始
        $image = $request->file('image');
        // バケットの`myprefix`フォルダへアップロード
        $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
        // アップロードした画像のフルパスを取得
        $url = Storage::disk('s3')->url($path);
        $user->image = $url;
        $user->save();

        return back();
    }
    
    /**
     * ユーザページの表示
     *
     * @return void
     * @var object $auths ログインユーザ
     * @var object $bikes 登録中の全ての自転車
     * @var object $reservations ログインユーザの全予約
     */
    public function index()
    {
        $auths = Auth::user();
        $bikes = Bike::all();
        $reservations = Reservation::where('user_id', $auths->id)->get();

        return view('users.index', ['auth' => $auths, 'bikes' => $bikes, 'reservations' => $reservations]);
    }
    
    /**
     * ユーザ情報変更画面の表示
     *
     * @param int $id ユーザid
     * @return void
     * @var object $auth ログインユーザのレコード
     */
    public function edit(int $id)
    {
        $auth = User::findOrFail($id);

        //ログインユーザーとログインユーザーのレコードが一致する場合
        if (Auth::id() === $auth->id){
            return view('users.edit', ['auth' => $auth]);
        }
        
        return back();
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
