<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Storage;
use App\Consts\Url;

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

    /**
     * ユーザーのアバターをDBとS3バケットへ保存する
     *
     * @param object $request 登録するアバター画像
     * @return void
     */
    public function registerUserAvatar($request){
        // ログインユーザーを取得する
        $user = Auth::user();
        // 削除するs3の画像特定のためにDBに保存されているs3の画像パスを取得する
        $image_keypath = str_replace(Url::URL_LIST['s3'], '', $user->image);
        // S3上の既存アバター画像を削除する
        Storage::disk('s3')->delete($image_keypath);
        // S3アップロード開始
        $image = $request->file('image');
        // バケットの`avatars`フォルダへアップロード
        $path = Storage::disk('s3')->putFile('avatars', $image, 'public');
        // アップロードした画像のフルパスを取得
        $user->image = Storage::disk('s3')->url($path);
        $user->save();
    }
}
