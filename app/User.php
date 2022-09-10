<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\{Auth, Hash};
use Storage;
use App\Consts\Url;
use App\{Bike, Reservation};

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
        // DBにアバターを保存する
        $user->save();
    }

    /**
     * ログインユーザーの情報を変更する
     *
     * @param object $request ログインユーザーの情報変更リクエスト
     * @param int $user_id ログインユーザーのid
     * @return void
     */
    public function updateUserInfo($request, $user_id){
        // ログインユーザーを取得する
        $login_user = User::findOrFail($user_id);
        // 情報変更リクエストを変数に代入
        $form = $request->all();
        
        // フォームトークン削除
        unset($form['_token']);
        // ログインユーザーの情報を更新する
        $login_user->fill($form)->save();
        //パスワードをハッシュ化して更新する
        $login_user->fill(['password' => Hash::make($request->password)])->save();
    }

    /**
     * ユーザーマイページ表示用の情報を取得する
     *
     * @return array マイページ表示用情報
     */
    public function getUserPageInfo(){
        $login_user = Auth::user();
        $bikes = Bike::all();
        $reservations = Reservation::where('user_id', $login_user->id)->get();
        
        return [$login_user, $bikes, $reservations];
    }
}
