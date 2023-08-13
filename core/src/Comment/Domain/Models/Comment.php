<?php

namespace Core\src\Comment\Domain\Models;

final class Comment
{
    /**
     * @var SenderId
     */
    private $senderId;
    /**
     * @var ReceiverId
     */
    private $receiverId;
    /**
     * @var CommentBody
     */
    private $commentBody;

    public function __construct($senderId, $receiverId, $commentBody)
    {
        $this->senderId = $senderId;
        $this->receiverId = $receiverId;
        $this->commentBody = $commentBody;
    }

    public function senderId(): SenderId
    {
        return $this->senderId;
    }

    public function receiverId(): ReceiverId
    {
        return $this->receiverId;
    }

    public function commentBody(): CommentBody
    {
        return $this->commentBody;
    }
}
