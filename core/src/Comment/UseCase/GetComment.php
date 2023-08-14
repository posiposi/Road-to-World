<?php

namespace Core\src\Comment\UseCase;

use Core\src\Bike\Domain\Models\BikeId;
use Core\src\Comment\Domain\Models\Comment;
use Core\src\Comment\Domain\Models\ReceiverId;
use Core\src\Comment\Domain\Models\SenderId;
use Core\src\Comment\UseCase\Ports\GetCommentQueryPort;

final class GetComment
{
    /**
     * @var GetCommentQueryPort
     */
    private $getCommentQueryPort;

    public function __construct(GetCommentQueryPort $getCommentQueryPort)
    {
        $this->getCommentQueryPort = $getCommentQueryPort;
    }

    public function execute(
        SenderId $senderId,
        ReceiverId $receiverId,
        BikeId $bikeId
    ): Comment {
        return $this->getCommentQueryPort->getComment($senderId, $receiverId, $bikeId);
    }
}
