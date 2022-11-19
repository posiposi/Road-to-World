<?php
namespace App\Services\Image;

use App\Consts\Url;

/**
 * S3サービスクラス
 */
class S3Service{
    /**
     * S3に保存されている画像パスを配列形式で取得する
     *
     * @return array string S3に保存されている画像パス
     */
    public static function getImages(){
        return 
        [
            '1' => URL::URL_LIST['s3'] . URL::PICTURE_ACCESS_LIST['how_to_picuture1'],
            //TODO 下記2〜4はネタ画像のためカルーセル実装完了後に削除 or 差し替えをすること
            '2' => URL::URL_LIST['s3'] . URL::PICTURE_ACCESS_LIST['how_to_picuture2'],
            // '3' => URL::URL_LIST['s3'] . URL::PICTURE_ACCESS_LIST['how_to_picuture3'],
            // '4' => URL::URL_LIST['s3'] . URL::PICTURE_ACCESS_LIST['how_to_picuture4'],
            // '5' => URL::URL_LIST['s3'] . URL::PICTURE_ACCESS_LIST['how_to_picuture5']
        ];
    }
}