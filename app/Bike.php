<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    
    public function is_reservations($day, $hours, $minutes, $day_add)
    {
        return $this->reservations()->where([
            ['start_at', '<', $day + $day_add. ' '. $hours + $minutes], ['end_at', '>', $day + $day_add. ' '. $hours + $minutes]
        ])->exists();
    }
}
