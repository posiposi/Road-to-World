<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Bike extends Model
{
    protected $fillable = [
        'name', 'brand', 'status', 'bike_address', 'image_path', 'price', 'remark',
    ];
    
    /*
    * 一対多の記述(バイクは複数のユーザに従属)
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /*
    *多対多の記述(多数のバイクが中間テーブルを通して多数のユーザに予約される。)
    */
    public function reserved()
    {
        return $this->belongsToMany(User::class, 'reservations', 'bike_id', 'user_id');
    }
    
    //一対多の記述(バイクは複数のコメントを所有)
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    //一対多の記述(バイクは複数の予約を所持)
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    
    /**
     * 予約有無の確認
     * 
     * 該当する予約がすでにあるかを確認するメソッド
     * 
     * @param string $day 週初めの月曜日の日付
     * @param int $hours 00〜23時までの時間(1時間ずつ増加)
     * @param string $minutes 00or30分(30分単位で増加)
     * @param int $day_add 曜日ごとに0〜7を代入するための値(月曜なら0、火曜なら1といったように)
     * 
     * @return boolean 予約ありでtrue、予約なしでfalse
     */
    public function is_reservations($day, $hours, $minutes, $day_add)
    {
        $dt = Carbon::create($day)->addDay($day_add);
        $dt->hour = $hours;
        $dt->minute = $minutes;
        return $this->reservations()->where([['start_at', '<=', $dt], ['end_at', '>', $dt]])->exists();
    }
}
