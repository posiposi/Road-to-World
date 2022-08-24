<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Comment extends Model
{
    protected $fillable = [
        'body', 'sender_id', 'receiver_id', 'bike_id',
    ];
    
    /** 一対多の記述(コメントは一人のユーザに従属) */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /** 一対多の記述(コメントは一台のバイクに従属) */
    public function bike()
    {
        return $this->belongsTo(Bike::class);
    }
    
    /** 一対多の記述(コメントは複数のリプライを所有) */
    public function riplies()
    {
        return $this->hasMany(Reply::class);
    }

    /** コメント作成日時をフォーマットする(アクセサ) */
    public function getCreatedAtAttribute($datetime)
    {
        // 国際標準時を取得し、日本時間に合致させるために9時間を追加する
        $date = Carbon::parse($datetime);
        $date->addHours(9);
        // 時刻をフォーマットしてカラムに返却
        return $date->format('m-d H:i');
    }
}
