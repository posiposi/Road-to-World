<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http;
use Illuminate\Support\Facades\Storage;
use App\Bike;

class BikesController extends Controller
{
    //自転車登録画面表示
    public function show()
    {
        return view('auth.bikeregister');
    }
    
    //自転車登録メソッド
    public function store(Request $request)
    {
        //バリデーション
        $request->validate([
            'brand' => 'required',
            'name' => 'required',
            'status' => 'required',
            'bike_address' => 'required',
            'image_path' => 'required | file | image | dimensions:max_width=1500,max_height=1500 | max:2048',
        ]);
        
        //ユーザーのバイク情報登録メソッド
        $bike = $request->user()->bikes()->create([
            'brand' => $request->brand,
            'name' => $request->name,
            'status' => $request->status,
            'bike_address' => $request->bike_address,
            'image_path' => $request->image_path,
        ]);
        
        //s3アップロード開始
        $image = $bike->image_path;
        // バケットの`myprefix`フォルダへアップロード
        $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
        // アップロードした画像のフルパスを取得
        $url = Storage::disk('s3')->url($path);
        $bike->image_path = $url;
        $bike->save();
        
        return back();
    }
    
    //貸出中自転車一覧の表示メソッド
    public function index(Request $request)
    {
        $bikes = \App\Bike::all();
        return view('bikes.index', ['bikes' => $bikes]);
    }
}