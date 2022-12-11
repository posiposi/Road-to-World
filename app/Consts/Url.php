<?php

namespace App\Consts;

class Url
{
    // URLの定数リスト
    const URL_LIST = [
        's3' => 'https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/'
    ];

    // S3内の画像ファイルのアクセスパス
    const PICTURE_ACCESS_LIST = [
        'welcome_logo' => 'welcome/logomark.png',
        'mainpage_carousel_1' => 'welcome/main_visual.webp',
        'mainpage_carousel_2' => 'welcome/main_visual_2.jpg',
        'mainpage_carousel_3' => 'welcome/main_visual_3.jpg',
        'mainpage_carousel_4' => 'welcome/main_visual_4.jpg',
        // NoImageアバター画像
        'avatar_noimage' => 'welcome/no-image.png',
    ];
}
