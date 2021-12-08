<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['start_at', 'end_at', 'payment'];
    
    //一対多の記述(予約は1台の自転車に従属)
    public function bike()
    {
        return $this->belongsTo(Bike::class);
    }
    
    //予約有無確認(00分台)
    public function is_just_reservations($bikeId, $day, $time)
    {
        return $this->where('bike_id', $bikeId)->whereDate('start_at', $day)->whereTime('start_at', $time. ':00:00')->exists();
    }
    //予約有無確認(30分台)
    public function is_half_reservations($bikeId, $day, $time)
    {
        return $this->where('bike_id', $bikeId)->whereDate('start_at', $day)->whereTime('start_at', $time. ':30:00')->exists();
    }
}
