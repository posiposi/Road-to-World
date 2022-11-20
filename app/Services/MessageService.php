<?php

namespace App\Services;

use App\Consts\Message;

/**
 * メッセージサービスクラス
 */
class MessageService{
    /**
     * メインページに表示する文章を取得する
     *
     * @return array メインページに表示する文章
     */
    public static function getMainPageText(){
        return
        [
            // サブタイトル
            'sub_title' => Message::MAINPAGE_TEXT['sub_title'],
            // メインテキスト
            'main_text' => Message::MAINPAGE_TEXT['main_text']
        ];
    }
}