<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Bike;

class Reservation extends Model
{
    protected $fillable = ['start_at', 'end_at', 'payment'];
    
    /**
     * リレーション：予約は1台の自転車に帰属する
     *
     * @return void
     */
    public function bike()
    {
        return $this->belongsTo(Bike::class);
    }

    /**
     * リレーション：予約は1人のユーザーに帰属する
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 予約リクエストの時間に既存の予約があるかを確認する
     *
     * @param object $request 予約リクエスト
     * @param int $bike_id 予約希望対象自転車のid
     * @return array DBおよび支払い処理のための各情報
     */
    public function isExistsBikeReserved($request, $bike_id){
        // ログインユーザーを取得
        $auth_id = Auth::id();
        // 予約希望の対象自転車を取得
        $bike = Bike::find($bike_id);
        // 予約開始の希望時間
        $start_time = new Carbon($request->start_date. ' ' .$request->start_time);
        // 予約終了の希望時間
        $end_time = new Carbon($request->end_date. ' ' .$request->end_time);
        // 予約時間の長さを計算(開始-終了)
        $carbon_diff = $start_time->diffInMinutes($end_time);
        // 合計料金計算用に３０分単位で除算
        $time = $carbon_diff / 30;
        // 予約希望の時間に既存の予約があるかを確認し取得
        $exists = Reservation::where([
            ['bike_id', $bike_id], ['start_at', '<', $end_time], ['end_at', '>', $start_time]
        ])->exists();

        return [$auth_id, $bike, $start_time, $end_time, $time, $exists];
    }
}
