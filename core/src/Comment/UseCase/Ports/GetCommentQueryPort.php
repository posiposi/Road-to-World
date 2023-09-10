<?php

namespace Core\src\Comment\UseCase\Ports;

use Core\src\Bike\Domain\Models\BikeId;
use Core\src\Comment\Domain\Models\CommentList;
use Core\src\Comment\Domain\Models\ReceiverId;
use Core\src\Comment\Domain\Models\SenderId;

interface GetCommentQueryPort
{
    public function getCommentList(
        SenderId $senderId,
        ReceiverId $receiverId,
        BikeId $bikeId
    ): CommentList;
}
