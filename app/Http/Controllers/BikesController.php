<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Bike;
use App\User;

class BikesController extends Controller
{
    //自転車登録画面表示
    public function show()
    {
        return view('auth.bikeregister');
    }
    
    //自転車登録
    public function store(Request $request)
    {
        //バリデーション
        $request->validate([
            'brand' => 'required',
            'name' => 'required',
            'status' => 'required',
            'bike_address' => 'required',
            'image_path' => 'required | file | image | dimensions:max_width=1500,max_height=1500 | max:2048',
            'price' => 'required | numeric',
            'remark' => 'required | string',
        ]);
        
        //ユーザーのバイク情報登録
        $bike = $request->user()->bikes()->create([
            'brand' => $request->brand,
            'name' => $request->name,
            'status' => $request->status,
            'bike_address' => $request->bike_address,
            'price' => $request->price,
            'remark' => $request->remark,
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
    
    //貸出中自転車一覧の表示
    public function index(Request $request)
    {
        $bikes = \App\Bike::all();
        $users = Auth::user();
        return view('bikes.index', ['bikes' => $bikes, 'users' => $users]);
    }
    
    //自転車情報変更画面表示
    public function edit($id)
    {
        $bikes = Bike::findOrFail($id);
        return view('bikes.edit', ['bikes' => $bikes]);
    }
    
    //自転車情報変更
    public function update(Request $request, $id)
    {
        //バリデーション
        $request->validate([
            'brand' => 'required',
            'name' => 'required',
            'status' => 'required',
            'bike_address' => 'required',
            'price' => 'required | numeric',
            'remark' => 'required | string',
            'image_path' => 'required | file | image | dimensions:max_width=1500,max_height=1500 | max:2048',
        ]);
        
        $bike = Bike::findOrFail($id);
        $form = $request->all();
        $bike->fill($form)->save();
        //画像S3アップロード
        $image = $request->image_path;
        $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
        // アップロードした画像のフルパスを取得
        $url = Storage::disk('s3')->url($path);
        $bike->image_path = $url;
        $bike->save();

        return redirect('/users');
    }
    
    public function destroy($id)
    {
        $bike = \App\Bike::findOrFail($id);
        if (\Auth::id() === $bike->user_id)
        {
            $bike->delete();
        }
        
        return back();
    }
}