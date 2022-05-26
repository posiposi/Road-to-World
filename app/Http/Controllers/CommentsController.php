<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Bike;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentPostRequest;

class CommentsController extends Controller
{
    /**
     * コメントルーム一覧表示
     *
     * @param int $bikeId 対象となる自転車のid
     * @param int $lenderId ログイン中ユーザ(対象となる自転車の所有者)
     * @return void
     */
    public function index($bikeId, $lenderId)
    {
        /**
         * @var object $bikes 対象となる自転車
         * @var string $users_all 対象となる自転車の所有者以外のユーザ
         * @var string $login_user ログイン中ユーザのid
         */
        $bikes = Bike::findOrFail($bikeId);
        $users = User::where('id', '!=', $lenderId)->get();
        $login_user = Auth::id();
        /*ログインユーザーがバイク所有者でない場合 */
        if($login_user != $bikes->user_id){
            return view('comments.index', ['bikes' => $bikes, 'users' => $users]);
        }
        else{
            return view('comments.index', ['bikes' => $bikes, 'users' => $users]);
        }
    }
    
    /**
     * コメントルームの表示
     *
     * @param int $bikeId 対象となる自転車のid
     * @param int $borrowerId ログイン中ユーザのid
     * @param int $lenderId 対象となる自転車の保有者id
     * @return void
     */
    public function show($bikeId, $senderId, $receiverId)
    {
        /**
         * @var object $bike レンタル対象となる自転車
         * @var int    $login_user ログイン中ユーザのid
         * @var object $sender コメント送信者
         * @var object $sender_comments レンタル希望者のコメント
         * @var object $reciever レンタル対象となる自転車の所有者
         * @var object $receiver_comments レンタル対象となる自転車の所有者コメント
         */
        $bike = Bike::findOrFail($bikeId);
        $login_user = Auth::id();
        $sender = User::findOrFail($senderId);
        $sender_comments = Comment::where([['sender_id', $senderId], ['reciever_id', $receiverId], ['bike_id', $bike->id]])->pluck('body', 'id');
        $reciever = User::findOrFail($receiverId);
        $reciever_comments = Comment::where([['sender_id', $receiverId], ['reciever_id', $senderId], ['bike_id', $bike->id]])->pluck('body', 'id');
        /*
         * ログインユーザのidチェックと条件分岐
         * ログインユーザーがコメント送信者か受信者であり、
         * なおかつレンタル対象自転車のユーザーidがコメント送信者か受信者ならばコメントページへ変遷させる
         * 
         * @var array $times カレンダー項目表示のための0〜24時までの時間(h)
         */
        if($login_user == $sender->id || $login_user == $reciever->id ){
            if($bike->user_id == $senderId || $bike->user_id == $receiverId){
                if($senderId != $receiverId){
                    $times = [];
                    for ($i = 0; $i < 48; $i++){
                        $times[] = date("H:i", strtotime("+". $i * 30 . "minute", (-3600*9)));
                    };
                    return view(
                        'comments.show', 
                        ['bikes' => $bike, 'login_user' => $login_user, 'sender' => $sender, 'sender_comments' => $sender_comments, 
                        'reciever' => $reciever, 'reciever_comments' => $reciever_comments, 'login_user' => $login_user, 'times' => $times]
                    );
                } else{
                    return back();
                }
            } else{
                return back();
            }
        } else{
            return back();
        }
    }
    
    /**
     * コメントの保存
     *
     * @param Request $request
     * @param int $bikeId 対象となる自転車のid
     * @param int $recieverId レンタル希望者のid
     * @return void
     */
    public function store(CommentPostRequest $request, $bikeId, $senderId, $recieverId)
    {
        /**
         * @var object $user ログイン中ユーザ
         * @var object $bike 対象となる自転車
         */
        $user = Auth::user();
        $bike = Bike::where('id', $bikeId)->get();
        
        /* コメントの内容 */
        $comment = new Comment;
        $comment->body = $request->body;
        $comment->sender_id = $senderId;
        $comment->bike_id = $bikeId;
        $comment->reciever_id = $recieverId; 
        $comment->save();
        
        //json用に送信者・受信者の最新コメントを取得する
        $sender_allcomments = Comment::where([['bike_id', $bikeId], ['sender_id', $senderId], ['reciever_id', $recieverId]])->latest()->value('body');
        $reciever_allcomments = Comment::where([['bike_id', $bikeId], ['sender_id', $recieverId], ['reciever_id', $senderId]])->latest()->value('body');

        return response()->json([$sender_allcomments]);
        return back();
    }
}