<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Bike;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    //コメントルーム一覧表示
    public function index($bikeId, $senderId, $commentId)
    {
        $bikes = \App\Bike::find($bikeId);
        $users = \Auth::user($senderId);
        $comments = \App\Comment::find($commentId);
        return view('comments.index', ['bikes' => $bikes, 'users' => $users, 'comments' => $comments,]);
    }
    
    //コメントルーム表示
    public function show($bikeId, $senderId, $commentId)
    {
        $bike = \App\Bike::where('id', $bikeId)->get();
        $sender = \Auth::user($senderId);
        $sender_comments = \App\Comment::where('sender_id', $commentId)->pluck('body');
        return view('comments.show', ['bikes' => $bike, 'senderId' => $sender, 'sender_comments' => $sender_comments]);
    }
    
    //コメント保存
    public function store(Request $request, $bikeId, $recieverId)
    {
        $user = \Auth::user();
        $bike = \App\Bike::where('id', $bikeId)->get();
        
        //コメント内容
        $comment = new Comment;
        $comment->body = $request->body;
        $comment->sender_id = $user->id;
        $comment->bike_id = $bikeId;
        $comment->reciever_id = $recieverId;
        $comment->save();
        
        return back();
    }
}
