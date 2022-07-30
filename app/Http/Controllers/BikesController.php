<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Bike;
use App\Http\Requests\BikeRegisterRequest;

class BikesController extends Controller
{
    /**
     * コメントルーム一覧表示
     *
     * @return void
     */
    public function show()
    {
        return view('auth.bikeregister');
    }
    
    /**
     * 貸出自転車の登録
     *
     * @param BikeRegisterRequest $request 
     * @return void
     */
    public function store(BikeRegisterRequest $request)
    {
        /**
         * ユーザ情報リクエスト
         *
         * @var array{
         *   brand: string,
         *   name: string,
         *   status: string,
         *   bike_address: string,
         *   price: int,
         *   remark: string,
         * } 
        */
        $bike = $request->user()->bikes()->create([
            'brand' => $request->brand,
            'name' => $request->name,
            'status' => $request->status,
            'bike_address' => $request->bike_address,
            'price' => $request->price,
            'remark' => $request->remark,
            'image_path' => $request->image_path,
        ]);
        
        /**
         * 自転車登録の情報
         * 
         * @var object $bike 登録する自転車
         */
        $image = $bike->image_path;
        $name = time() . pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $path = Storage::disk('s3')->put('bikes/' . $name, $image, 'public');
        /**
         * @method string Illuminate\Support\Facades url()
         */
        $url = Storage::disk('s3')->url($path);
        $bike->image_path = $url;
        $bike->save();
        
        return redirect('/users');
    }
    
    /**
     * 貸出中自転車一覧の表示
     * 
     * @var string $bikes 貸出中の全ての自転車
     * @var string $users ログイン中ユーザ
     * @var array $times カレンダー項目表示のための0〜24時までの時間
     * 
     */
    public function index(Request $request)
    {
        //表示する自転車のページネーション
        $bikes = Bike::paginate(6);
        $users = Auth::user();
        $times = [];

        //カレンダーに表示する日付・時刻を配列に代入
        for ($i = 0; $i < 48; $i++){
            $times[] = date("H:i", strtotime("+". $i * 30 . "minute", (-3600*9)));
        };
        return view('bikes.index', ['bikes' => $bikes, 'users' => $users, 'times' => $times]);
    }
    
    /**
     * 自転車情報の変更
     *
     * @param int $id 対象自転車のid
     * @var object $bikes 対象となる自転車
     * @return void
     */
    public function edit(int $id)
    {
        $bikes = Bike::findOrFail($id);
        return view('bikes.edit', ['bikes' => $bikes]);
    }
    
    /**
     * 自転車の変更保存
     *
     * @param BikeRegisterRequest $request
     * @param int $id 対象自転車のid
     * @param array $form 自転車の変更情報
     * @var object $bike 対象となる既存自転車の登録情報
     * @return void
     */
    public function update(BikeRegisterRequest $request, int $id)
    {
        //変更対象自転車の既存情報を取得する
        $bike = Bike::findOrFail($id);
        //ユーザー側の変更リクエストを取得する
        $form = $request->all();
        //DBに保存されている画像のフルパスからs3のURLパラメータを削除する
        $image_keypath = str_replace('https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/', '', $bike->image_path);
        //該当するs3上の既存画像を削除する
        Storage::disk('s3')->delete($image_keypath);
        //自転車の変更リクエストDBに保存する
        $bike->fill($form)->save();

        //画像S3アップロード
        $image = $request->image_path;
        $path = Storage::disk('s3')->putFile('bikes', $image, 'public');
        //アップロードした画像のフルパスを取得
        $url = Storage::disk('s3')->url($path);
        //自転車画像のパスに上記フルパスを代入
        $bike->image_path = $url;
        $bike->save();

        //ユーザー情報画面へ画面変遷する
        return redirect('/users');
    }
    
    /**
     * 登録自転車の削除
     *
     * @param int $id 自転車のid
     * @var object $bike 対象の自転車レコード
     * @return void
     */
    public function destroy(int $id)
    {
        //変更対象自転車の既存情報を取得する
        $bike = Bike::findOrFail($id);
        
        //ログインユーザーと削除対象自転車の所有者が同一の場合
        if (Auth::id() === $bike->user_id)
        {
            //DBに保存されている画像のフルパスからs3のURLパラメータを削除する
            $image_keypath = str_replace('https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/', '', $bike->image_path);
            
            //該当するs3上の既存画像を削除する
            Storage::disk('s3')->delete($image_keypath);
            //DB上の既存自転車の情報を削除する
            $bike->delete();
        }
        
        //遷移元へ画面変遷する
        return back();
    }
}