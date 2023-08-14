<?php

namespace App\Adapters\Bike;

use Core\src\Comment\Domain\Models\SenderId;
use Core\src\Comment\Domain\Models\ReceiverId;
use Core\src\Bike\Domain\Models\BikeId;
use Core\src\Comment\Domain\Models\Comment;
use Core\src\Comment\UseCase\Ports\GetCommentQueryPort;
use App\Comment as EloquentComment;

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

    public function getComment(SenderId $senderId, ReceiverId $receiverId, BikeId $bikeId): Comment
    {
        return $this->eloquentComment->toModel($senderId, $receiverId, $bikeId);
    }
}
