<?php

namespace App\Consts;

class Word
{
    /**
     * ワードリスト
     */
    const WORD_LIST = [
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'login' => 'ログイン',
        'signup' => '初めての方はこちら',
        'bikes_index' => '貸出中の自転車はこちらから',
        'search' => '貸出中の自転車を検索する',
        'not_comma' => '価格はコンマなしで入力してください。',
        'within_140words' => '140文字以内で入力してください。',
        'required_content' => 'は必須項目です。',
        'copyright_icon' => '©',
        'copyright' => 'Copyright: Daichi Sugiyama',
    ];

    /**
     * 各ページのタイトル
     */
    const PAGE_TITLE = [
        'bike_register' => 'マイバイク登録',
        'bike_info_change' => 'マイバイク登録情報変更',
        'bike_index' => '貸し出し中の自転車',
        'mypage' => 'マイページ',
        'mybike' => 'マイバイク',
    ];

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
        'select_bike_image' => 'アップロードする画像を選択してください。',
    ];

    /**
     * 自転車一覧画面のラベルテキスト
     */
    const BIKE_INDEX_LABEL = [
        'owner' => '所有者：',
        'brand' => 'ブランド：',
        'bike_name' => 'モデル名：',
        'bike_status' => '保管状態：',
        'bike_address' => '受け渡し場所：',
        'price_yen' => '料金：¥',
        'per_thirty_minutes' => '/30分',
        'remark' => '説明・備考',
        'start_date' => '開始日 ',
        'start_time' => '開始時間',
        'end_date' => '終了日 ',
        'end_time' => '終了時間',
        'btn_bike_reservation' => '予約',
        'to_comment_room_index' => 'コメントルーム一覧へ',
        'to_comment_room' => 'コメントルームへ',
        'reservation_calendar' => '予約状況カレンダー',
    ];

    /**
     * マイページのラベルテキスト
     */
    const MYPAGE_LABEL = [
        'user_name' => '氏名',
        'user_nickname' => 'ニックネーム',
        'user_mail' => 'メールアドレス',
        'user_tel' => '電話番号',
        'user_info' => '会員情報',
        'reservation_calendar' => '予約表',
        'mybike' => 'マイバイク',
        'logout' => 'ログアウト',
        'alt_register_avatar' => '登録アバター画像',
        'alt_default_avatar' => 'デフォルトアバター画像',
    ];

    /**
     * 決済ボタンページのラベルテキスト
     */
    const PAYMENT_LABEL = [
        'payment_completed' => '決済が完了しました！',
        'back_to_bikes_index' => '自転車一覧画面に戻る',
    ];
}
