<?php

namespace App\Http\Controllers;

use App\Consts\Url;
use Illuminate\Http\Request;

class TopPageController extends Controller
{
    // TODO サービスクラスへメソッド分離をする
    /**
     * メインページに表示するロゴのS3パスを取得する
     *
     * @return string $welcome_logo_path メインページ上部ロゴのS3パス
     */
    public function getMainPageLogoUrl() : string
    {
        // S3パスを取得し返却する
        return Url::URL_LIST['s3'] . Url::PICTURE_ACCESS_LIST['welcome_logo'];
    }

    /**
     * メインページを表示する
     */
    public function index()
    {
        // メインページ表示時にメインページロゴパスを同時に渡す
        $welcome_logo_path = self::getMainPageLogoUrl();
        return view('welcome', compact('welcome_logo_path'));
    }
}
