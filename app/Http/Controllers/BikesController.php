<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Bike;
use App\User;
use App\Reservation;
use Carbon\Carbon;
use DateTime;
use Intervention\Image\Facades\Image;
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
         * } $bike
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
        
        $image = $bike->image_path;
        $name = time() . pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $path = Storage::disk('s3')->put('myprefix/' . $name, $image, 'public');
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
        $bikes = \App\Bike::paginate(6);
        $users = Auth::user();
        $times = [];
        for ($i = 0; $i < 48; $i++){
            $times[] = date("H:i", strtotime("+". $i * 30 . "minute", (-3600*9)));
        };
        return view('bikes.index', ['bikes' => $bikes, 'users' => $users, 'times' => $times]);
    }
    
    /**
     * 自転車情報の変更
     *
     * @param int $id 対象自転車のid
     * @return void
     */
    public function edit($id)
    {
        $bikes = Bike::findOrFail($id);
        return view('bikes.edit', ['bikes' => $bikes]);
    }
    
    /**
     * 自転車の変更保存
     *
     * @param BikeRegisterRequest $request
     * @param int $id 対象自転車のid
     * @return void
     */
    public function update(BikeRegisterRequest $request, $id)
    {
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