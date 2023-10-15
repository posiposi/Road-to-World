<?php

namespace App\Http\Controllers\Message;

use App\Events\MessageAdded;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SendMessageController extends Controller
{
    private $message;

    // TODO 要Requestクラスでのバリデーション #445
    public function __invoke(Request $request, int $loginUserId, int $anotherUserId, int $bikeId)
    {
        $this->message = $request->input('message');
        $param = [
            'bike_id' => $bikeId,
            'receiver_id' => $anotherUserId,
            'sender_id' => $loginUserId,
            'body' => $this->message,
            'created_at' => now()
        ];
        DB::table('comments')->insert($param);

        $sendMessage = DB::table('comments')
            ->where('bike_id', $bikeId)
            ->where('receiver_id', $anotherUserId)
            ->where('sender_id', $loginUserId)
            ->latest()->first();
        // メッセージ送信イベント発行
        event((new MessageAdded($sendMessage))->dontBroadcastToCurrentUser());
    }
}
