<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Bike;
use App\Consts\{Date, Time};

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

    /**
     * 予約状況カレンダーを表示する
     *
     * @param integer $bikeId 該当自転車のid
     * @param string $week 画面遷移後に表示する週
     * @param string $now 現在表示中の週
     * @return array 画面表示に必要な各種変数
     */
    public function showReservationStatusCalendar(int $bikeId, string $week, string $now){
        $bike = Bike::findOrFail($bikeId);
        //今週
        if ($week == Date::DATE_TYPE_LIST['this_week'] && $now == Date::DATE_TYPE_LIST['today']) {
            $dt = new Carbon();
        //翌週へ
        } elseif ($week == Date::DATE_TYPE_LIST['next_week']) {
            $day = new Carbon($now);
            $dt = $day->addweek();
        //先週へ
        } else {
            $day = new Carbon($now);
            $dt = $day->subweek();
        }
        $days[0] = $dt->format('m/d');
        for ($i = 0; $i < 7; $i++) {
            $monday = $dt->startOfWeek();
            $days[$i] = $monday->copy()->addDay($i)->format('m/d');
        };
        // 時間を24時、各時間30分ずつで表示するために配列へ時・分を設定する
        for ($i = 0; $i < 24; $i++){
            $times[] = date("H", strtotime("+". $i * 60 . Time::TIME_TYPE_LIST['minute'], (-3600*9)));
        };

        return [$bike, $days, $times, $dt];
    }
}
