<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentPostRequest;

class CommentsController extends Controller
{
    // コンストラクタインジェクション
    public function __construct(Comment $comment)
    {
        // コメントクラスのインスタンスを生成
        $this->comment = $comment;
    }

    /**
     * コメントルーム一覧表示
     *
     * @param int $bikeId 対象となる自転車のid
     * @param int $lenderId ログイン中ユーザ(対象となる自転車の所有者)
     * @return void
     */
    public function index(int $bikeId, int $lenderId)
    {
        /**
         * コメントルーム一覧で必要な情報を取得し、配列化する
         * 
         * @var object $bike 対象自転車のインスタンス
         * @var object $user 対象自転車を所有していないユーザーのインスタンス
         */
        [$bike, $user] = $this->comment->getInfoForBikesIndex($bikeId, $lenderId);

        // ログインユーザーが対象自転車の所有者の場合はコメントルーム一覧に画面変遷する
        if(Auth::id() == $bike->user_id){
            return view('comments.index', compact('bike', 'user'));
        }
        // ログインユーザーが対象自転車の所有者でない場合は直前画面へリダイレクトする
        return back();
    }
    
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
        [$bike, $login_user, $sender, $sender_comments, $receiver, $receiver_comments] = $this->comment->getInfoToShowCommentRoomShow($bikeId, $senderId, $receiverId);

        /*
         * ログインユーザのidチェックと条件分岐
         * ログインユーザーがコメント送信者か受信者であり、
         * なおかつレンタル対象自転車のユーザーidがコメント送信者か受信者ならばコメントページへ変遷させる
         */
        if($login_user == $sender->id || $login_user == $receiver->id ){
            if($bike->user_id == $senderId || $bike->user_id == $receiverId){
                if($senderId != $receiverId){
                    $times = [];
                    for ($i = 0; $i < 48; $i++){
                        $times[] = date("H:i", strtotime("+". $i * 30 . "minute", (-3600*9)));
                    };
                    // コメントページを表示するための変数を同時に渡す
                    return view(
                        'comments.show', compact('bike', 'login_user', 'sender', 'sender_comments', 'receiver', 'receiver_comments', 'times')
                    );
                }
                else {
                    return back();
                }
            }
            else {
                return back();
            }
        }
        else {
            return back();
        }
    }
    
    /**
     * コメントの保存
     *
     * @param Request $request コメント本文
     * @param int $bikeId 対象となる自転車のid
     * @param int $senderId コメント送信者のユーザーid
     * @param int $receiverId コメント受信者のユーザーid
     * @return void
     */
    public function store(CommentPostRequest $request, int $bikeId, int $senderId, int $receiverId)
    {
        // コメントを保存する
        $this->comment->saveComment($request, $bikeId, $senderId, $receiverId);
    }

    /**
     * ログインユーザーと自転車所有者のコメントをJSONで返却する
     *
     * @param int $bikeId 対象自転車のid
     * @param int $senderId コメント送信者のid
     * @param int $receiverId コメント受信者のid
     * @return array コメント送信者と受信者のコメントのJSON
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