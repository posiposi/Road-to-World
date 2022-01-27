<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Bike;
use Storage;
use App\Http\Requests\UserRegisterRequest;

class UsersController extends Controller
{
    /**
     * ユーザアバター登録
     *
     * @param Request $request 画像リクエスト
     * @return void
     * @var object $user ログインユーザのレコード
     */
    public function store(Request $request)
    {
        $user = \Auth::user();
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
     * ユーザのMyPage表示
     *
     * @return void
     * @var object $auth ログインユーザのレコード
     * @var array $bikes 登録されている全自転車
     */
    public function index()
    {
        $auths = \Auth::user();
        $bikes = \App\Bike::all();
        return view('users.index', ['auth' => $auths, 'bikes' => $bikes]);
    }
    
    /**
     * ユーザ情報変更画面の表示
     *
     * @param int $id ログインユーザのid
     * @return void
     * @var array $auth ログインユーザのレコード
     */
    public function edit($id)
    {
        $auth = User::findOrFail($id);
        if (\Auth::id() === $auth->id){
            return view('users.edit', ['auth' => $auth]);
        }
        
        return back();
    }
    
    /**
     * ユーザ情報変更
     * 
     * @return void
     * @param int $id ログインユーザのid
     * @property object $auth ログインユーザのレコード
     * @property array $form 変更リクエスト
     */
    public function update(UserRegisterRequest $request, $id)
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
