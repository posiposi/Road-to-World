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
        'name', 'email', 'password', 'image', 'tel', 'nickname',
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
        'tel' => 'string'
    ];
    
    /** 一対多の記述(このUserは多数のBikeを所持する) */
    public function bikes()
    {
        return $this->hasMany(Bike::class);
    }
    
    /**
     * 多対多の記述(多数のユーザが中間テーブルを通して多数の自転車を予約する。)
     * 
     * @param object reservations 予約テーブル
     * @param int user_id レンタル希望者のユーザid
     * @param int bike_id 対象自転車のid
     */    
    public function reserving()
    {
        return $this->belongsToMany(Bike::class, 'reservations', 'user_id', 'bike_id')->withTimestamps();
    }
    
    /**
     * 予約している自転車の中に対象の自転車があるか確認
     * 
     * @param int $bikeId 対象自転車のid
     * @return boolean 存在する:true 存在しない:false
     */
    public function is_reserving(int $bikeId)
    {
        return $this->reserving()->where('bike_id', $bikeId)->exists();
    }
    
    /** 一対多の記述(ユーザは複数のコメントを所有) */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /** リレーション：1人のユーザーは多数の予約を所有する */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
