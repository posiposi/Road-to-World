<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GetMessagesController extends Controller
{
    public function __invoke()
    {
        // TODO 本実装時に挿入データを正規のものにすること
        $senderId = Auth::id();
        $bikeId = 9;
        $receiverId = 2;
        $query = DB::table('comments')
            ->where('bike_id', $bikeId)
            ->where('receiver_id', $receiverId)
            ->where('sender_id', $senderId)
            ->get();
        return $query;
    }
}
