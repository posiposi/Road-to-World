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
    /**
     * コメントルーム一覧表示
     *
     * @param int $bikeId 対象となる自転車のid
     * @param int $senderId ログイン中ユーザのid
     * @return void
     */
    public function index($bikeId, $senderId)
    {
        /**
         * @var object $bikes 対象となる自転車
         * @var string $sender ログイン中ユーザ
         * @var string $users_all 対象となる自転車の所有者以外のユーザ
         * @var string $login_user ログイン中ユーザのid
         */
        $bikes = \App\Bike::findOrFail($bikeId);
        $users = \App\User::where('id', '!=', Auth::user()->id)->get();
        $users_all = \App\User::where('id', '!=', $bikes->user_id)->get();
        $login_user = \Auth::id();
        if($login_user != $bikes->user_id){
            return view('comments.index', ['bikes' => $bikes, 'users' => $users_all]);
        }
        else{
            return view('comments.index', ['bikes' => $bikes, 'users' => $users]);
        }
    }
    
    /**
     * コメントルームの表示
     *
     * @param int $bikeId 対象となる自転車のid
     * @param int $senderId ログイン中ユーザのid
     * @return void
     */
    public function show($bikeId, $senderId)
    {
        /**
         * @var object $bike 対象となる自転車
         * @var object $sender ログイン中ユーザ
         * @var object $sender_comments レンタル希望者のコメント
         */
        $bike = \App\Bike::findOrFail($bikeId);
        $sender = \App\User::findOrFail($senderId);
        $sender_comments = \App\Comment::where([['sender_id', $senderId], ['reciever_id', $bike->user_id], ['bike_id', $bike->id]])->pluck('body', 'id');
        /**
         * @var object $reciever 対象となる自転車
         * @var object $receiver_comments 対象となる自転車の所有者のコメント
         */
        $reciever = \App\User::findOrFail($bike->user_id);
        $reciever_comments = \App\Comment::where([['sender_id', $reciever->id], ['reciever_id', $sender->id], ['bike_id', $bike->id]])->pluck('body', 'id');
        /**
         * ログインユーザのidチェックと条件分岐
         * 
         * @var $login_user ログイン中ユーザのid
         */
        $login_user = \Auth::id();
        if($senderId != $bike->user_id){
            if($login_user == $sender->id || $login_user == $reciever->id ){
                /**
                 * @var array $times カレンダー項目表示のための0〜24時までの時間
                 */
                $times = [];
                for ($i = 0; $i < 48; $i++){
                    $times[] = date("H:i", strtotime("+". $i * 30 . "minute", (-3600*9)));
                };
                return view('comments.show', ['bikes' => $bike, 'login_user' => $login_user, 'sender' => $sender, 'sender_comments' => $sender_comments, 
                        'reciever' => $reciever, 'reciever_comments' => $reciever_comments, 'login_user' => $login_user, 'times' => $times]);
            }
            else{
                return back();
            }
        }
        else{
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
    public function store(Request $request, $bikeId, $recieverId)
    {
        /**
         * @var object $user ログイン中ユーザ
         * @var object $bike 対象となる自転車
         */
        $user = \Auth::user();
        $bike = \App\Bike::where('id', $bikeId)->get();
        
        /* コメントの内容 */
        $comment = new Comment;
        $comment->body = $request->body;
        $comment->sender_id = $user->id;
        $comment->bike_id = $bikeId;
        $comment->reciever_id = $recieverId; 
        $comment->save();
        
        return back();
    }
}
