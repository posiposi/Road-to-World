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
        return $this->belongsTo('User::class');
    }
}
