<?php

namespace App\Http\Controllers;

use App\Consts\Url;
use App\Services\Image\S3Service;
use Illuminate\Http\Request;
use App\Http\Controllers\ServiceController;

/**
 * トップページコントローラクラス
 */
class TopPageController extends Controller
{
    /**
     * メインページを表示する
     */
    public function index()
    {
        // S3に保存されているメインページのロゴURLを取得する
        $welcome_logo_path = app()->make(ServiceController::class)->getMainPageLogo();
        // メインページを表示する
        return view('welcome', compact('welcome_logo_path'));
    }
}
