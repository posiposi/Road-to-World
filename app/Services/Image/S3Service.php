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
            '1' => URL::URL_LIST['s3'] . URL::PICTURE_ACCESS_LIST['mainpage_carousel_1'],
            '2' => URL::URL_LIST['s3'] . URL::PICTURE_ACCESS_LIST['mainpage_carousel_2'],
            '3' => URL::URL_LIST['s3'] . URL::PICTURE_ACCESS_LIST['mainpage_carousel_3'],
            '4' => URL::URL_LIST['s3'] . URL::PICTURE_ACCESS_LIST['mainpage_carousel_4'],
        ];
    }

    /**
     * S3に保存されているメインページロゴのパスを取得する
     *
     * @return string メインページロゴのパス
     */
    public static function getMainPageLogoUrl()
    {
        return Url::URL_LIST['s3'] . Url::PICTURE_ACCESS_LIST['welcome_logo'];
    }

    /**
     * S3に保存されているアバターNoImage画像のパスを取得する
     *
     * @return string アバターNoImage画像のパス
     */
    public static function getAvatarNoImage()
    {
        return URL::URL_LIST['s3'] . URL::PICTURE_ACCESS_LIST['avatar_noimage'];
    }
}