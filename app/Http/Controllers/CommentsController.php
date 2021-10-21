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
    public function index($bikeId, $senderId)
    {
        $bikes = \App\Bike::findOrFail($bikeId);
        $users = \App\User::all();
        $sender = \App\User::findOrFail($senderId);
        //$sender_comments = \App\Comment::find($senderId);
        return view('comments.index', ['bikes' => $bikes, 'users' => $users, 'sender' => $sender, /*'sender_comments' => $sender_comments,*/]);
    }
    
    //コメントルーム表示
    public function show($bikeId, $senderId)
    {
        $bike = \App\Bike::findOrFail($bikeId);
        $reciever = \App\User::findOrFail($bike->user_id);
        $sender = \App\User::findOrFail($senderId);
        $sender_comments = \App\Comment::where('sender_id', $senderId)->pluck('body');
        $reciever_comments = \App\Comment::where('reciever_id', $reciever->id)->pluck('body');
        return view('comments.show', ['bikes' => $bike, 'sender' => $sender, 'sender_comments' => $sender_comments, 
                    'reciever' => $reciever, 'reciever_comments' => $reciever_comments,]);
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
