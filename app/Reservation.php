<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
