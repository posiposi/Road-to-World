<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DateTimeRequest;
use Carbon\Carbon;
use App\Bike;

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
        $time = $start_carbon->diffInMinutes($end_carbon);
        $time = $carbon_diff + (30 - $carbon_diff % 30); //30分単位で切り上げ

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
                ]);
            return redirect(route('payment.index',
            [
                'time' => $time,
                'price' => $bike_price,
            ]));
        }
        //予約済みの場合
        else {
            $test_alert = "<script type='text/javascript'>alert('ご希望の時間は予約済みになっています。');</script>";
            echo $test_alert;
        }
    }
}
