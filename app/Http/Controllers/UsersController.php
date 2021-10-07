<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
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
        return view('users.index', ['auth' => $auths]);
    }
}
