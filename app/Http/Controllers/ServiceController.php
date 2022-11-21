<?php

namespace App\Http\Controllers;

use App\Services\Image\S3Service;
use App\Services\MessageService;

/**
 * サービスコントローラクラス
 */
class ServiceController extends Controller
{
    /**
     * S3から画像を取得し、JSON形式で返却する
     *
     * @return array<string> 取得した画像のS3URLパス
     */
    public function show(){
        return response()->json(["how_to_images" => S3Service::getImages()]);
    }

    /**
     * メインページのロゴを取得する
     *
     * @return string メインページのロゴURL
     */
    public function getMainPageLogo(){
        // S3サービスクラスのメインページロゴURL取得メソッドを呼び出し
        return S3Service::getMainPageLogoUrl();
    }

    /**
     * メインページに表示する文章を取得する
     *
     * @return array サブタイトルとメインテキスト
     */
    public function getMainPageText(){
        // メッセージサービスクラスのメインページテキスト取得メソッドを呼び出し
        return response()->json(["texts" => MessageService::getMainPageText()]);
    }
}
