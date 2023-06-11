<?php

namespace App\Adapters\Bike;

use Core\src\Bike\Domain\Models\Bike;
use App\Consts\Url;
use Core\src\Bike\UseCase\Ports\UpdateBikeImageCommandPort;
use Illuminate\Support\Facades\Storage;

class UpdateBikeImageAdapter implements UpdateBikeImageCommandPort
{
    function updateBikeImage(Bike $request, array $bike): string
    {
        // DBに保存されている既存画像のフルパスからS3URLパラメータを除いたパスを取得
        $imageKeypath = str_replace(Url::URL_LIST['s3'], '', $bike['image_path']);
        // 該当するs3上の既存画像を削除する
        Storage::disk('s3')->delete($imageKeypath);
        // TODO 下記別アダプターに切り出し(登録のみの場合は既存パスが無いため)
        // 画像をS3にアップロード
        $path = Storage::disk('s3')->putFile('bikes', $request->imagePath()->toString(), 'public');
        $url = Storage::disk('s3')->url($path);

        return $url;
    }
}
