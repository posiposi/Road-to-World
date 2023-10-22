<?php

namespace App;

use App\{Bike, User};
use Carbon\Carbon;
use Core\src\Bike\Domain\Models\BikeId;
use Core\src\Comment\Domain\Models\Comment as ModelsComment;
use Core\src\Comment\Domain\Models\ReceiverId;
use Core\src\Comment\Domain\Models\SenderId;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

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
        return $date->format('m/d H:i');
    }

    public function getComment(SenderId $senderId, ReceiverId $receiverId, BikeId $bikeId): Collection
    {
        $query = $this->newQuery();
        $comments = $query->where('sender_id', $senderId->toInt())
            ->join('users', 'comments.sender_id', '=', 'users.id')
            ->where('receiver_id', $receiverId->toInt())
            ->where('bike_id', $bikeId->toInt())
            ->select('users.nickname', 'comments.body', 'comments.created_at')
            ->get();
        return $comments;
    }

    /**
     * コメントルーム一覧で表示する情報を取得する
     *
     * @param int $bikeId 対象の自転車id
     * @param int $lenderId 借り手側ユーザーid
     */
    // TODO コアレイヤパターンを適用したら削除
    public function getInfoForBikesIndex($bikeId, $lenderId): array
    {
        $bike = Bike::findOrFail($bikeId);
        $users = User::where('id', '!=', $lenderId)->get();
        return [$bike, $users];
    }

    /**
     * コメントルーム表示用の情報を取得する
     *
     * @param int $bikeId 対象自転車のid
     * @param int $senderId 借り手側ユーザーのid
     * @param int $receiverId 貸し手側ユーザーのid
     * @return array コメントルーム一覧表示用の情報
     */
    public function getInfoToShowCommentRoomShow($bikeId, $senderId, $receiverId)
    {
        $bike = Bike::findOrFail($bikeId);
        $login_user = Auth::id();
        $sender = User::findOrFail($senderId);
        $sender_comments = Comment::where([['sender_id', $senderId], ['receiver_id', $receiverId], ['bike_id', $bike->id]])->pluck('body', 'id');
        $receiver = User::findOrFail($receiverId);
        $receiver_comments = Comment::where([['sender_id', $receiverId], ['receiver_id', $senderId], ['bike_id', $bike->id]])->pluck('body', 'id');
        return [$bike, $login_user, $sender, $sender_comments, $receiver, $receiver_comments];
    }

    public function saveComment(array $param): void
    {
        $query = $this->newQuery();
        $query->create([
            'bike_id' => $param['bikeId'],
            'sender_id' => $param['senderId'],
            'receiver_id' => $param['receiverId'],
            'body' => $param['body'],
            'created_at' => $param['sendDateTime']
        ]);
    }

    public function toModel(array $values): ModelsComment
    {
        return ModelsComment::fromArray($values);
    }
}
