<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Bike;
use Storage;

class UsersController extends Controller
{
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
    
    public function index()
    {
        $auths = \Auth::user();
        $bikes = \App\Bike::all();
        return view('users.index', ['auth' => $auths, 'bike' => $bikes]);
    }
    
    //ユーザ情報変更画面表示
    public function edit($id)
    {
        $auth = User::findOrFail($id);
        if (\Auth::id() === $auth->id){
            return view('users.edit', ['auth' => $auth]);
        }
        
        return back();
    }
    
    //ユーザ情報変更
    public function update(Request $request, $id)
    {
        // 対象レコード取得
        $auth = User::findOrFail($id);
        $form = $request->all();
        // フォームトークン削除
        unset($form['_token']);
        // レコードアップデート
        $auth->fill($form)->save();
        $auth->fill(['password' => Hash::make($request->password)])->save(); //パスワードハッシュ化
        
        return redirect('/users');
    }
}
