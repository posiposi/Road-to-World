<?php

namespace App\Consts;

class Word
{
    // ワードリスト
    const WORD_LIST = [
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'login' => 'ログイン',
        'signup' => '初めての方はこちら',
        'bikes_index' => '貸出中の自転車はこちらから',
        'search' => '貸出中の自転車を検索する',
        'not_comma' => '価格はコンマなしで入力してください。',
        'within_150words' => '150文字以内で入力してください。',
    ];

    // 各ページのタイトル
    const PAGE_TITLE = [
        'bike_register' => 'マイバイク登録',
        'bike_info_change' => 'マイバイク登録情報変更',
        'bike_index' => '貸し出し中の自転車',
    ];
}