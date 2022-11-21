<?php
namespace App\Consts;

class Message{
    const MESSAGE_LIST = [
        'rental_self_bike' => 'あなた自身の自転車は借りることが出来ません。',
        'reserved' => 'ご希望の時間は予約済みになっています。',
        'not_existing_bikes' => '該当する自転車がありませんでした。'
    ];

    const SHOW_MESSAGE_TYPE = [
        'flash' => 'flash_message'
    ];

    const MAINPAGE_TEXT = [
        'main_title' => 'ようこそロードバイクの世界へ',
        'sub_title' => '一覧の中から自転車をレンタル！手元から世界へ漕ぎ出しましょう！',
        'main_text' => "Road to Worldは自転車レンタルを通じて世界へ走り出す人々の手助けをします。\n購入・使用の敷居が高いロードバイクを借りることで新しい世界を見つけられるでしょう。\nまた、複数自転車を所有している人にはレンタル自転車を登録することで、購入費用の回収とロードバイクの世界を多くの人に紹介する機会になります。\nアプリ製作者の理念は上記を通じて日本の人々にロードバイクの世界を知ってもらうことにあります。\nロードバイクを借りて世界へ通じる'道'へ走り出しましょう！"
    ];
}