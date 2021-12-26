<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DateTimeRequest;
use Carbon\Carbon;
use App\Bike;
use App\Reservation;

class ReservationController extends Controller
{
    /**
     * 自転車予約アクション
     * 
     * @param int $id 予約対象自転車のid
     */
    public function store(DateTimeRequest $request, $id) {
        /**
         * storeメソッド内の変数の説明
         * 
         * @var array $bike 予約対象自転車の情報
         * @var int $bike_price 予約対象自転車の料金
         * @var string $reservation_start_at 開始日時リクエスト
         * @var string $reservation_end_at 終了日時リクエスト
         */
        $bike = \App\Bike::find($id);
        $bike_price = $bike->price;
        $reservation_start_at = $request->start_date. ' ' .$request->start_time;
        $reservation_end_at = $request->end_date. ' ' .$request->end_time;
        
        /**
         * 予約確認と条件分岐のために必要な変数の説明
         * 
         * @var string $start_carbon 開始日時リクエストのCarbon化
         * @var string $end_carbon 終了日時リクエストのCarbon化
         * @var int $carbon_diff 開始日時と終了日時の時間差
         * @var int $time 上記時間差を30分単位で割り出し
         */
        $start_carbon = new Carbon($reservation_start_at);
        $end_carbon = new Carbon($reservation_end_at);
        $carbon_diff = $start_carbon->diffInMinutes($end_carbon);
        $time = $carbon_diff / 30;

        /**
         * 予約確認と条件分岐
         * 
         * @var bool $exists 対象自転車の予約リクエストが重複するかの確認
         */
        $exists = DB::table('reservations')->where([
            ['bike_id', $id], ['start_at', '<', $reservation_end_at], ['end_at', '>', $reservation_start_at]
        ])->exists();
        /**
         * 重複する予約がない場合
         */
        if ($exists != true) { 
            $reservation = $request->user()->reserving()->attach(
                $id,
                [
                'start_at' => $request->start_date. ' ' .$request->start_time,
                'end_at' => $request->end_date. ' ' .$request->end_time,
                'payment' => 0, //予約段階では未決済のためfalseとして0を挿入
                ]);
            return redirect(route('payment.index',
            [
                'time' => $time,
                'price' => $bike_price,
                'bikeId' => $bike->id,
                'startTime' => $start_carbon,
                'endTime' => $end_carbon,
            ]));
        }
        /**
         * 重複する予約がある場合
         */
        else {
            $test_alert = "<script type='text/javascript'>alert('ご希望の時間は予約済みになっています。');</script>";
            echo $test_alert;
        }
    }
    
    /**
     * 予約状況カレンダーの表示アクション
     * 
     * @param int $bikeId 対象自転車のID
     * @param string $week
     * @param string $now
     */
    public function index($bikeId, $week, $now) {
        $bike = \App\Bike::findOrFail($bikeId);
        //今週
        if ($week == 'this_week' && $now == 'today') {
            $dt = new Carbon();
        //翌週へ
        } elseif ($week == 'next_week') {
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
        
        /**
         * view側の表を作成するための変数についての説明
         * 
         * @var array $times 0〜24時までを1時間毎で配列化
         * @var array $minutes viewで@foreachを使用するために空配列を作成
         */
        $times = [];
        $minutes = [];
        for ($i = 0; $i < 24; $i++){
            $times[] = date("H", strtotime("+". $i * 60 . "minute", (-3600*9)));
        };
        return view('calendars.index', 
            ['bike' => $bike, 'dt'=> $dt, 'days' => $days, 'times' => $times, 'minutes' => $minutes, 'bikeId' => $bikeId]);
    }
}