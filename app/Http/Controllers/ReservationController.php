<?php

namespace App\Http\Controllers;

use App\Http\Requests\DateTimeRequest;
use Carbon\Carbon;
use App\Bike;
use App\Reservation;
use App\Consts\Message;
use App\Consts\Date;
use App\Consts\Time;

class ReservationController extends Controller
{
    /**
     * 自転車を予約する
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
                return back()->with(Message::SHOW_MESSAGE_TYPE['flash'], Message::MESSAGE_LIST['rental_self_bike']);
            }
        }
        // 重複する予約がある場合
        else {
            return back()->with(Message::SHOW_MESSAGE_TYPE['flash'], Message::MESSAGE_LIST['reserved']);
        }
    }
    
    /**
     * 予約状況カレンダーを表示する
     * 
     * @param int $bikeId 対象自転車のID
     * @param string $week カレンダー表示のための暫定ワード
     * @param string $now カレンダー表示のための暫定ワード
     */
    public function index(int $bikeId, string $week, string $now) {
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
        
        /**
         * view側の表を作成するための変数
         * 
         * @var array $times 0〜24時までを1時間毎で配列化
         * @var array $minutes viewで@foreachを使用するために空配列を作成
         */
        $times = [];
        $minutes = [];
        for ($i = 0; $i < 24; $i++){
            $times[] = date("H", strtotime("+". $i * 60 . Time::TIME_TYPE_LIST['minute'], (-3600*9)));
        };
        return view('calendars.index', 
            ['bike' => $bike, 'dt'=> $dt, 'days' => $days, 'times' => $times, 'minutes' => $minutes, 'bikeId' => $bikeId]);
    }
}