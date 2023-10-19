<?php

namespace App\Http\Controllers\Message;

use App\Events\MessageAdded;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\SendRequest;
use Illuminate\Support\Facades\DB;

class SendMessageController extends Controller
{
    private $message;

    public function __invoke(SendRequest $request, int $loginUserId, int $anotherUserId, int $bikeId)
    {
        $this->message = $request->message();
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
