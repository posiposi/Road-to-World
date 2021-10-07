<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    //自転車予約メソッド
    public function store(Request $request, $id) {
        
        global $reservation_start_at;
        global $reservation_end_at;
        //開始日時リクエストを代入
        $reservation_start_at = $request->start_date. ' ' .$request->start_time;
        //終了日時リクエストを代入
        $reservation_end_at = $request->end_date. ' ' .$request->end_time;        
        
        //バリデーション
        $rules = [
            'start_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_date' => 'required|date',
            'end_time' => 'required|date_format:H:i',
        ];
        
        $this->validate($request, $rules); 
        
        //DB内で同一のbike_idかつ希望時間が重なるか確認、変数へ代入
        //予約確認・条件分岐
        $exists = DB::table('reservations')
        ->where('bike_id', $id) 
        ->where('start_at', '<', $reservation_end_at)
        ->where('end_at', '>', $reservation_start_at)
        ->exists(); //希望日時が被ってるときはtrueを返す
        
        
        if ($exists != true) { 
        //予約アクション
            $reservation = $request->user()->reserving()->attach(
                $id,
                [
                'start_at' => $request->start_date. ' ' .$request->start_time,
                'end_at' => $request->end_date. ' ' .$request->end_time,
                ]);
            return back()->with('result', '予約が完了しました。');
        }
        //予約済みの場合
        else {
            echo 'ご希望の時間は予約済みになっています。';
        }
    }
}
