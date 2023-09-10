<?php

namespace App\Adapters\Comment;

use App\Comment as EloquentComment;
use Core\src\Bike\Domain\Models\BikeId;
use Core\src\Comment\Domain\Models\CommentList;
use Core\src\Comment\Domain\Models\ReceiverId;
use Core\src\Comment\Domain\Models\SenderId;
use Core\src\Comment\UseCase\Ports\GetCommentQueryPort;


class GetCommentAdapter implements GetCommentQueryPort
{
    /**
     * @var EloquentComment
     */
    private $eloquentComment;

    public function __construct(EloquentComment $eloquentComment)
    {
        $this->eloquentComment = $eloquentComment;
    }

    public function getCommentList(SenderId $senderId, ReceiverId $receiverId, BikeId $bikeId): CommentList
    {
        $values = $this->eloquentComment->getComment($senderId, $receiverId, $bikeId)->toArray();
        return CommentList::fromArray($values);
    }
}
