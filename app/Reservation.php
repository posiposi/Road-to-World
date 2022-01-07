<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['start_at', 'end_at', 'payment'];
    
    /** 一対多の記述(予約は1台の自転車に従属) */
    public function bike()
    {
        return $this->belongsTo(Bike::class);
    }
}
