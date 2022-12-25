<?php
namespace App\Consts;

/**
 * メッセージクラス
 */
class Message{

    /**
     * 予約ページメッセージリスト
     */
    const RENTAL_MESSAGE_LIST = [
        'rental_self_bike' => 'あなた自身の自転車は借りることが出来ません。',
        'reserved' => 'ご希望の時間は予約済みになっています。',
        'not_existing_bikes' => '該当する自転車がありませんでした。'
    ];

    /**
     * フラッシュメッセージ
     */
    const SHOW_MESSAGE_TYPE = [
        'flash' => 'flash_message'
    ];

    /**
     * メインページ主要部のテキスト
     */
    const MAINPAGE_TEXT = [
        // メインタイトル
        'main_title' => 'ようこそロードバイクの世界へ',
        // サブタイトル
        'sub_title' => '一覧の中から自転車をレンタル！手元から世界へ漕ぎ出しましょう！',
        // メインテキスト
        'main_text' => "Road to Worldは自転車レンタルを通じて世界へ走り出す人々の手助けをします。\n購入・使用の敷居が高いロードバイクを借りることで新しい世界を見つけられるでしょう。\nまた、複数自転車を所有している人にはレンタル自転車を登録することで、購入費用の回収とロードバイクの世界を多くの人に紹介する機会になります。\nアプリ製作者の理念は上記を通じて日本の人々にロードバイクの世界を知ってもらうことにあります。\nロードバイクを借りて世界へ通じる'道'へ走り出しましょう！"
    ];

    /**
     * フッター部のコンテンツタイトル
     */
    const FOOTER_CONTENTS_TITLE = 'Road-to-Worldの想い';

    /**
     * フッター部のコンテンツテキスト
     */
    const FOOTER_CONTENTS_TEXT = "購入の敷居が高いロードバイクが日本の人々に身近な存在になってほしい。"
    .PHP_EOL."そんな想いを込めて本アプリの開発を進めています。"
    .PHP_EOL."アプリ名称の'to World'は'ロードバイクの世界へ'という意味と'世界に通じる選手の第一歩'という意味を込めています。";

    /**
     * 自転車登録、変更フォームのラベルテキスト
     */
    const BIKE_FORM_LABEL = [
        'brand' => 'ブランド',
        'bike_name' => 'モデル名',
        'bike_status' => '保管状態',
        'bike_address' => '受け渡し場所',
        'price' => '料金(¥/30分)',
        'remark' => '説明・備考',
        'btn_bike_info_register' => '登録',
        'btn_bike_info_change' => '変更',
    ];
}