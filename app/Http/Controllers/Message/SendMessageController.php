<?php

namespace App\Http\Controllers\Message;

use App\Events\MessageAdded;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SendMessageController extends Controller
{
    private $message;

    public function __invoke(Request $request)
    {
        $this->message = $request->input('message');
        // TODO 本実装時に挿入データを正規のものにすること
        $userId = Auth::id();
        $param = [
            'bike_id' => 9,
            'receiver_id' => 2,
            'sender_id' => $userId,
            'body' => $this->message,
            'created_at' => now()
        ];
        DB::table('comments')->insert($param);
        $sendMessage = DB::table('comments')
            ->where('bike_id', 9)
            ->where('receiver_id', 2)
            ->where('sender_id', $userId)
            ->latest()->first();
        // メッセージ送信イベント発行
        event((new MessageAdded($sendMessage))->dontBroadcastToCurrentUser());
    }
}
