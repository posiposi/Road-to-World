<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    protected $fillable = [
        'name', 'brand', 'status', 'bike_address', 'image_path'
    ];
    
    /*
    * 一対多の記述(多数のBikeを一人のUserが所有する)
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
}
