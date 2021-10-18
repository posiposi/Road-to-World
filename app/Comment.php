<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'body', 'user_id', 'bike_id',
    ];
    
    //一対多の記述(コメントは一人のユーザに従属)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    //一対多の記述(コメントは一台のバイクに従属)
    public function bike()
    {
        return $this->belongsTo(Bike::class);
    }
    
    //一対多の記述(コメントは複数のリプライを所有)
    public function riplies()
    {
        return $this->hasMany(Reply::class);
    }
}
