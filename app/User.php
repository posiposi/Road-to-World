<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image', 'tel'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /*
    *一対多の記述(このUserは多数のBikeを所持する)
    */
    public function bikes()
    {
        return $this->hasMany(Bike::class);
    }
    
    /*
    *多対多の記述(多数のユーザが中間テーブルを通して多数の自転車を予約する。)
    */
    
    public function reserving()
    {
        return $this->belongsToMany(Bike::class, 'reservations', 'user_id', 'bike_id')->withTimestamps();
    }
    
    /*
    *予約している自転車の中に$bikeIdを持つ自転車があるか確認(重複回避のため)
    */
    public function is_reserving($bikeId)
    {
        return $this->reserving()->where('bike_id', $bikeId)->exists();
    }
    
}
