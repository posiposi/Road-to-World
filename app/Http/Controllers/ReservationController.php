<?php

namespace App\Http\Controllers;

use App\Http\Requests\DateTimeRequest;
use Carbon\Carbon;
use App\Bike;
use App\Reservation;

class ReservationController extends Controller
{
    /**
     * 自転車予約アクション
     * 
     * @param int $bike_id 予約対象自転車のid
     */
    public function store(DateTimeRequest $request, int $bike_id, Reservation $reservation) {
        [$auth_id, $bike, $start_time, $end_time, $time, $exists] = $reservation->isExistsBikeReserved($request, $bike_id);

        //重複する予約がない場合
        if (!$exists) { 
            // 自転車が予約希望者の自転車ではない場合
            if ($auth_id != $bike->user_id) {
                $reservation = $request->user()->reserving()->attach(
                    $bike_id,
                    [
                        'start_at' => $start_time,
                        'end_at' => $end_time,
                        'payment' => 0,
                    ]);
                return redirect(route('payment.index',
                [
                    'time' => $time,
                    'price' => $bike->price,
                    'bikeId' => $bike->id,
                    'startTime' => $start_time,
                    'endTime' => $end_time,
                ]));
            }
            //予約対象が予約者自身の所有自転車の場合
            else {
                return back()->with('flash_message', 'あなた自身の自転車は借りることが出来ません。');
            }
        }
        // 重複する予約がある場合
        else {
            return back()->with('flash_message', 'ご希望の時間は予約済みになっています。');
        }
    }
    
    /**
     * 予約状況カレンダーの表示アクション
     * 
     * @param int $bikeId 対象自転車のID
     * @param string $week カレンダー表示のための暫定ワード
     * @param string $now カレンダー表示のための暫定ワード
     */
    public function index(int $bikeId, string $week, string $now) {
        $bike = Bike::findOrFail($bikeId);
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