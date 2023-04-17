<?php

namespace App\Adapters\Bike;

use App\UseCase\Ports\DeleteBikeCommandPort;
use Illuminate\Support\Facades\Auth;
use App\Consts\Url;
use Illuminate\Support\Facades\Storage;
use App\Bike;

class DeleteBikeAdapter implements DeleteBikeCommandPort
{
    public function deleteBike(int $bikeId): void
    {
        //変更対象自転車の既存情報を取得する
        $bikeToDelete = Bike::findOrFail($bikeId);

        //ログインユーザーと削除対象自転車の所有者が同一の場合は削除を実行する
        if (Auth::id() === $bikeToDelete->user_id) {
            //DBに保存されている画像のフルパスからs3のURLパラメータを削除する
            $image_keypath = str_replace(Url::URL_LIST['s3'], '', $bikeToDelete->image_path);
            //該当するs3上の既存画像を削除する
            Storage::disk('s3')->delete($image_keypath);
            //DB上の既存自転車の情報を削除する
            $bikeToDelete->delete();
        }
    }
}
