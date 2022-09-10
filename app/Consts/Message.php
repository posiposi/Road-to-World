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
}