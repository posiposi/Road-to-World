<?php

namespace App\Repositories;

use App\Bike;
use App\ValueObjects\Bike\BikeId;
use Illuminate\Support\Facades\Auth;
use App\Consts\Url;
use Illuminate\Support\Facades\Storage;

class BikeRepository implements BikeRepositoryInterface
{
    /**
     * 登録されている自転車を削除する
     *
     * @param BikeId $bikeId 削除対象の自転車ID
     * @return void
     */
    public function deleteBike(BikeId $bikeId)
    {
        //変更対象自転車の既存情報を取得する
        $registered_bike = Bike::findOrFail($bikeId->getValue());

        //ログインユーザーと削除対象自転車の所有者が同一の場合は削除を実行する
        if (Auth::id() === $registered_bike->user_id) {
            //DBに保存されている画像のフルパスからs3のURLパラメータを削除する
            $image_keypath = str_replace(Url::URL_LIST['s3'], '', $registered_bike->image_path);
            //該当するs3上の既存画像を削除する
            Storage::disk('s3')->delete($image_keypath);
            //DB上の既存自転車の情報を削除する
            $registered_bike->delete();
        }
    }
}
