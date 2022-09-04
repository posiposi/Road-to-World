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
        $auth_id = Auth::id();
        $bike = Bike::find($bike_id);
        $start_time = new Carbon($request->start_date. ' ' .$request->start_time);
        $end_time = new Carbon($request->end_date. ' ' .$request->end_time);
        $carbon_diff = $start_time->diffInMinutes($end_time);
        $time = $carbon_diff / 30;

        $exists = Reservation::where([
            ['bike_id', $bike_id], ['start_at', '<', $end_time], ['end_at', '>', $start_time]
        ])->exists();

        return [$auth_id, $bike, $start_time, $end_time, $time, $exists];
    }
}
