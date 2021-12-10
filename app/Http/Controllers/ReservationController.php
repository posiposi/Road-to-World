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
    //自転車予約メソッド
    public function store(DateTimeRequest $request, $id) {
        //自転車料金の取得
        $bike = \App\Bike::find($id);
        $bike_price = $bike->price;

        //開始日時リクエストを代入
        $reservation_start_at = $request->start_date. ' ' .$request->start_time;
        //終了日時リクエストを代入
        $reservation_end_at = $request->end_date. ' ' .$request->end_time;
        
        //Carbonメソッド使用
        $start_carbon = new Carbon($reservation_start_at);
        $end_carbon = new Carbon($reservation_end_at);
        $carbon_diff = $start_carbon->diffInMinutes($end_carbon);
        $time = $carbon_diff / 30;

        //DB内で同一のbike_idかつ希望時間が重なるか確認、変数へ代入
        //予約確認・条件分岐
        $exists = DB::table('reservations')
        ->where('bike_id', $id) 
        ->where('start_at', '<', $reservation_end_at)
        ->where('end_at', '>', $reservation_start_at)
        ->exists(); //希望日時が被ってるときはtrueを返すメソッド
        
        if ($exists != true) { 
        //予約アクション
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
        //予約済みの場合
        else {
            $test_alert = "<script type='text/javascript'>alert('ご希望の時間は予約済みになっています。');</script>";
            echo $test_alert;
        }
    }
    
    //カレンダー表示
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
        
        $times = [];
        $minutes = [];
        for ($i = 0; $i < 24; $i++){
            $times[] = date("H", strtotime("+". $i * 60 . "minute", (-3600*9)));
        };
        return view('calendars.index', 
            ['bike' => $bike, 'dt'=> $dt, 'days' => $days, 'times' => $times, 'minutes' => $minutes, /*'reservations' => $reservations,*/ 'bikeId' => $bikeId]);
    }
}