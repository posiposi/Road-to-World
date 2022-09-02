<?php

namespace App;

use App\Consts\Url;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class Bike extends Model
{
    protected $fillable = [
        'name', 'brand', 'status', 'bike_address', 'image_path', 'price', 'remark',
    ];
    
    /** 一対多の記述(バイクは複数のユーザに従属) */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /** 多対多の記述(多数のバイクが中間テーブルを通して多数のユーザに予約される。) */
    public function reserved()
    {
        return $this->belongsToMany(User::class, 'reservations', 'bike_id', 'user_id');
    }
    
    /** 一対多の記述(バイクは複数のコメントを所有) */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    /** 一対多の記述(バイクは複数の予約を所持) */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    
    /**
     * 予約有無の確認
     * 
     * 該当する予約がすでにあるかを確認する
     * 
     * @param array $day 週初めの月曜日の日付
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

    /**
     * 自転車を登録する
     *
     * @param object $request 登録する自転車の情報
     * @return void
     */
    public function registerBike($request)
    {
        // リクエストから登録する自転車のインスタンスを生成
        $bike = $request->user()->bikes()->create([
            'brand' => $request->brand,
            'name' => $request->name,
            'status' => $request->status,
            'bike_address' => $request->bike_address,
            'price' => $request->price,
            'remark' => $request->remark,
            'image_path' => $request->image_path,
        ]);
        
        // S3へ画像をアップロードする
        $image = $bike->image_path;
        $path = Storage::disk('s3')->putFile('bikes', $image, 'public');
        $url = Storage::disk('s3')->url($path);
        $bike->image_path = $url;
        $bike->save();
    }

    /**
     * 登録自転車を削除する
     *
     * @param integer $bike_id 削除対象自転車のid
     * @return void
     */
    public function deleteRegisteredBike(int $bike_id)
    {
        //変更対象自転車の既存情報を取得する
        $registered_bike = Bike::findOrFail($bike_id);
        
        //ログインユーザーと削除対象自転車の所有者が同一の場合
        if (Auth::id() === $registered_bike->user_id)
        {
            //DBに保存されている画像のフルパスからs3のURLパラメータを削除する
            $image_keypath = str_replace(Url::URLLIST['s3'], '', $registered_bike->image_path);
            //該当するs3上の既存画像を削除する
            Storage::disk('s3')->delete($image_keypath);
            //DB上の既存自転車の情報を削除する
            $registered_bike->delete();
        }
    }

    /**
     * 既存登録自転車の情報を変更する
     *
     * @param object $request 変更する情報リクエスト
     * @param integer $bike_id 対象となる自転車のid
     * @return void
     */
    public function updateRegisteredBike($request, int $bike_id)
    {
        //変更対象自転車の既存情報を取得する
        $bike = Bike::findOrFail($bike_id);
        //ユーザー側の変更リクエストを取得する
        $form = $request->all();
        //DBに保存されている画像のフルパスからs3のURLパラメータを削除する
        $image_keypath = str_replace(Url::URLLIST['s3'], '', $bike->image_path);
        //該当するs3上の既存画像を削除する
        Storage::disk('s3')->delete($image_keypath);
        //自転車の変更リクエストDBに保存する
        $bike->fill($form)->save();

        // S3へ画像をアップロードする
        $image = $request->image_path;
        $path = Storage::disk('s3')->putFile('bikes', $image, 'public');
        $url = Storage::disk('s3')->url($path);
        $bike->image_path = $url;
        $bike->save();
    }
}
