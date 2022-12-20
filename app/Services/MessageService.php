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
            // メインタイトル
            'main_title' => Message::MAINPAGE_TEXT['main_title'],
            // サブタイトル
            'sub_title' => Message::MAINPAGE_TEXT['sub_title'],
            // メインテキスト
            'main_text' => Message::MAINPAGE_TEXT['main_text']
        ];
    }

    /**
     * フッターに表示するコンテンツタイトルを取得する
     *
     * @return string フッターコンテンツのタイトル
     */
    public static function getFooterContentsTitle(){
        return Message::FOOTER_CONTENTS_TEXT;
    }
}