<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\{Bike, User};

class Comment extends Model
{
    protected $fillable = [
        'body', 'sender_id', 'receiver_id', 'bike_id',
    ];
    
    /** 一対多の記述(コメントは一人のユーザに従属) */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /** 一対多の記述(コメントは一台のバイクに従属) */
    public function bike()
    {
        return $this->belongsTo(Bike::class);
    }
    
    /** 一対多の記述(コメントは複数のリプライを所有) */
    public function riplies()
    {
        return $this->hasMany(Reply::class);
    }

    /** コメント作成日時をフォーマットする(アクセサ) */
    public function getCreatedAtAttribute($datetime)
    {
        // 国際標準時を取得し、日本時間に合致させるために9時間を追加する
        $date = Carbon::parse($datetime);
        $date->addHours(9);
        // 時刻をフォーマットしてカラムに返却
        return $date->format('m-d H:i');
    }

    /**
     * コメントルーム一覧で表示する情報を取得する
     *
     * @param int $bikeId 対象の自転車id
     * @param int $lenderId 借り手側ユーザーid
     * @return array 
     */
    public function getInfoForBikesIndex($bikeId, $lenderId){
        $bike = Bike::findOrFail($bikeId);
        $user = User::where('id', '!=', $lenderId)->get();
        return [$bike, $user];
    }

    /**
     * コメントルーム表示用の情報を取得する
     *
     * @param int $bikeId 対象自転車のid
     * @param int $senderId 借り手側ユーザーのid
     * @param int $receiverId 貸し手側ユーザーのid
     * @return array コメントルーム一覧表示用の情報
     */
    public function getInfoToShowCommentRoomShow($bikeId, $senderId, $receiverId){
        $bike = Bike::findOrFail($bikeId);
        $login_user = Auth::id();
        $sender = User::findOrFail($senderId);
        $sender_comments = Comment::where([['sender_id', $senderId], ['receiver_id', $receiverId], ['bike_id', $bike->id]])->pluck('body', 'id');
        $receiver = User::findOrFail($receiverId);
        $receiver_comments = Comment::where([['sender_id', $receiverId], ['receiver_id', $senderId], ['bike_id', $bike->id]])->pluck('body', 'id');
        return [$bike, $login_user, $sender, $sender_comments, $receiver, $receiver_comments];
    }

    /**
     * DBにコメントを保存する
     *
     * @param object $request コメント本文を含むオブジェクト
     * @param int $bikeId 対象自転車のid
     * @param int $senderId コメント送信者id
     * @param int $receiverId コメント受信者id
     * @return void
     */
    public function saveComment($request, $bikeId, $senderId, $receiverId){
        /* コメント本文 */
        $this->body = $request->body;
        /* コメント送信者ID */
        $this->sender_id = $senderId;
        /* レンタル対象自転車ID */
        $this->bike_id = $bikeId;
        /* コメント受信者ID */
        $this->receiver_id = $receiverId;
        /* DBにコメント情報を保存する */
        $this->save();
    }
}
