<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    public function index(int $bikeId, int $lenderId, Comment $comment)
    {
        /**
         * コメントルーム一覧で必要な情報を取得し、配列化する
         * 
         * @var object $bike 対象自転車のインスタンス
         * @var object $user 対象自転車を所有していないユーザーのインスタンス
         */
        [$bike, $user] = $comment->getInfoForBikesIndex($bikeId, $lenderId);

        // ログインユーザーが対象自転車の所有者の場合はコメントルーム一覧に画面変遷する
        if(Auth::id() == $bike->user_id){
            return view('comments.index', compact('bike', 'user'));
        }
        // ログインユーザーが対象自転車の所有者でない場合は直前画面へリダイレクトする
        return back();
    }
    
    // TODO Modelへ分離する
    /**
     * コメントルームの表示
     *
     * @param int $bikeId 対象となる自転車のid
     * @param int $borrowerId ログイン中ユーザのid
     * @param int $lenderId 対象となる自転車の保有者id
     * @return void
     */
    public function show(int $bikeId, int $senderId, int $receiverId)
    {
        /**
         * @var object $bike レンタル対象となる自転車
         * @var int    $login_user ログイン中ユーザのid
         * @var object $sender コメント送信者
         * @var object $sender_comments レンタル希望者のコメント
         * @var object $receiver レンタル対象となる自転車の所有者
         * @var object $receiver_comments レンタル対象となる自転車の所有者コメント
         */
        $bike = Bike::findOrFail($bikeId);
        $login_user = Auth::id();
        $sender = User::findOrFail($senderId);
        $sender_comments = Comment::where([['sender_id', $senderId], ['receiver_id', $receiverId], ['bike_id', $bike->id]])->pluck('body', 'id');
        $receiver = User::findOrFail($receiverId);
        $receiver_comments = Comment::where([['sender_id', $receiverId], ['receiver_id', $senderId], ['bike_id', $bike->id]])->pluck('body', 'id');
        /**
         * ログインユーザのidチェックと条件分岐
         * ログインユーザーがコメント送信者か受信者であり、
         * なおかつレンタル対象自転車のユーザーidがコメント送信者か受信者ならばコメントページへ変遷させる
         * 
         * @var array $times カレンダー項目表示のための0〜24時までの時間(h)
         */
        if($login_user == $sender->id || $login_user == $receiver->id ){
            if($bike->user_id == $senderId || $bike->user_id == $receiverId){
                if($senderId != $receiverId){
                    $times = [];
                    for ($i = 0; $i < 48; $i++){
                        $times[] = date("H:i", strtotime("+". $i * 30 . "minute", (-3600*9)));
                    };
                    return view(
                        'comments.show', 
                        ['bikes' => $bike, 'login_user' => $login_user, 'sender' => $sender, 'sender_comments' => $sender_comments, 
                        'receiver' => $receiver, 'receiver_comments' => $receiver_comments, 'login_user' => $login_user, 'times' => $times]
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
    
    // TODO Modelへ分離する
    /**
     * コメントの保存
     *
     * @param Request $request
     * @param int $bikeId 対象となる自転車のid
     * @param int $senderId コメント送信者のユーザーid
     * @param int $receiverId コメント受信者のユーザーid
     * @return void
     */
    public function store(CommentPostRequest $request, int $bikeId, int $senderId, int $receiverId)
    {
        /* コメントクラスのインスタンス化 */
        $comment = new Comment;
        /* コメント本文 */
        $comment->body = $request->body;
        /* コメント送信者ID */
        $comment->sender_id = $senderId;
        /* レンタル対象自転車ID */
        $comment->bike_id = $bikeId;
        /* コメント受信者ID */
        $comment->receiver_id = $receiverId;
        /* DB保存アクション */
        $comment->save();
    }

    // TODO Modelへ分離する
    /**
     * ログインユーザーと自転車所有者のコメントをJSONで返却する
     *
     * @param int $bikeId
     * @param int $senderId
     * @param int $receiverId
     * @return array
     */
    public function getSenderAndReceiverComment(int $bikeId, int $senderId, int $receiverId)
    {        
        // 対象自転車所有者向けのログインユーザーコメントを取得する
        $login_user_comments = Comment::where([['bike_id', $bikeId], ['sender_id', $senderId], ['receiver_id', $receiverId]]);
        // ログインユーザー向けの自転車所有者コメントを取得し、結合する
        $login_user_and_owner_comments = Comment::where([['bike_id', $bikeId], ['sender_id', $receiverId], ['receiver_id', $senderId]])->union($login_user_comments)->orderBy('created_at')->get();

        // 上記で結合したコメントをJSON形式で返却する
        return response()->json(["login_user_and_owner_comments" => $login_user_and_owner_comments]);
    }
}