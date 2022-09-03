<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Bike;
use App\Http\Requests\BikeRegisterRequest;

class BikesController extends Controller
{
    /**
     * 自転車登録画面表示
     *
     * @return void
     */
    public function show()
    {
        // 自転車登録画面へ変遷する
        return view('auth.bikeregister');
    }
    
    /**
     * 貸し出しする自転車の登録
     *
     * @param BikeRegisterRequest $request 
     * @return void
     */
    public function store(BikeRegisterRequest $request, Bike $bike)
    {
        // 自転車を登録する
        $bike->registerBike($request);
        // ログインユーザーのマイページへ画面変遷
        return redirect('/users');
    }
    
    // TODO Modelへ分離する
    /**
     * 貸出中自転車一覧画面の表示
     * 
     * @var string $bikes 貸出中の全ての自転車
     * @var string $users ログイン中ユーザ
     * @var array $times カレンダー項目表示のための0〜24時までの時間
     * 
     */
    public function index()
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
     * @param int $bike_id 対象自転車のid
     * @var object $bike 対象となる自転車
     * @return void
     */
    public function edit(int $bike_id)
    {
        $bike = Bike::findOrFail($bike_id);
        return view('bikes.edit', ['bike' => $bike]);
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
    public function update(BikeRegisterRequest $request, Bike $bike, int $id)
    {
        // idで該当自転車を検索し、登録情報を変更する
        $bike->updateRegisteredBike($request, $id);
        // ユーザー情報画面へ画面変遷する
        return redirect('/users');
    }
    
    /**
     * 登録自転車の削除
     *
     * @param int $bike_id 削除する自転車のid
     * @return void
     */
    public function destroy(Bike $bike, int $bike_id)
    {
        // 該当するidの自転車を削除する
        $bike->deleteRegisteredBike($bike_id);
        // 遷移元へ画面変遷する
        return back();
    }
}