<?php

namespace App\Adapters\Comment;

use App\Comment as EloquentComment;
use Core\src\Comment\Domain\Models\Comment;
use Core\src\Comment\UseCase\Ports\SaveCommentCommandPort;

class SaveCommentAdapter implements SaveCommentCommandPort
{
    /**
     * @var EloquentComment
     */
    private $eloquentComment;

    public function __construct(EloquentComment $eloquentComment)
    {
        $this->eloquentComment = $eloquentComment;
    }

    public function saveComment(Comment $comment): void
    {
        $commentParam = [
            'bikeId' => $comment->bikeId()->toInt(),
            'receiverId' => $comment->receiverId()->toInt(),
            'senderId' => $comment->senderId()->toInt(),
            'body' => $comment->commentBody()->toString(),
            'sendDateTime' => $comment->sendDateTime()
        ];
        $this->eloquentComment->saveComment($commentParam);
    }
}
