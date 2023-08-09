<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;

class RedirectMessageRoomController extends Controller
{
    public function __invoke()
    {
        return view('messages.index');
    }
}
