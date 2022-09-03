<?php

namespace App\Http\Controllers;

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
     * @param BikeRegisterRequest $request 登録する自転車の情報リクエスト
     * @return void
     */
    public function store(BikeRegisterRequest $request, Bike $bike)
    {
        // 自転車を登録する
        $bike->registerBike($request);
        // ログインユーザーのマイページへ画面変遷
        return redirect('/users');
    }
    
    /**
     * 貸出中自転車一覧画面の表示
     * 
     * @return void 
     */
    public function index(Bike $bike)
    {
        // メソッドで返却された配列を分割代入する
        [$bikes, $users, $times] = $bike->showBikesIndex();
        // 自転車一覧画面へ変遷する
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
     * @param BikeRegisterRequest $request 変更する自転車の情報リクエスト
     * @param int $id 対象自転車のid
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