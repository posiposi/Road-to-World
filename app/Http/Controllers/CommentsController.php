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
        $users = \App\User::all(); //全ユーザの取得
        //$sender = \App\User::findOrFail($senderId); //ログイン中ユーザの取得
        return view('comments.index', ['bikes' => $bikes, 'users' => $users, /*'sender' => $sender*/]);
    }
    
    //コメントルーム表示
    public function show($bikeId, $senderId)
    {
        $bike = \App\Bike::findOrFail($bikeId);
        //レンタル希望者、コメントの取得
        $sender = \App\User::findOrFail($senderId);
        $sender_comments = \App\Comment::where([['sender_id', $senderId], ['reciever_id', $bike->user_id], ['bike_id', $bike->id]])->pluck('body', 'id');
        //貸し出し主、コメントの取得
        $reciever = \App\User::findOrFail($bike->user_id);
        $reciever_comments = \App\Comment::where([['sender_id', $reciever->id], ['reciever_id', $sender->id], ['bike_id', $bike->id]])->pluck('body', 'id');
        //if文用インスタンス
        $login_user = \Auth::id(); //ログイン中ユーザid取得
        if($login_user == $sender->id || $login_user == $reciever->id){
            return view('comments.show', ['bikes' => $bike, 'login_user' => $login_user, 'sender' => $sender, 'sender_comments' => $sender_comments, 
                    'reciever' => $reciever, 'reciever_comments' => $reciever_comments, 'login_user' => $login_user]);
        }
        else{
            return back();
        }
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
