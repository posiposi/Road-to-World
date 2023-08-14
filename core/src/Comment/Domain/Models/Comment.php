<?php

namespace Core\src\Comment\Domain\Models;

use Core\src\Bike\Domain\Models\BikeId;

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
     * @var BikeId
     */
    private $bikeId;
    /**
     * @var CommentBody
     */
    private $commentBody;

    public function __construct($senderId, $receiverId, $bikeId, $commentBody)
    {
        $this->senderId = $senderId;
        $this->receiverId = $receiverId;
        $this->bikeId = $bikeId;
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

    public function bikeId(): BikeId
    {
        return $this->bikeId;
    }

    public function commentBody(): CommentBody
    {
        return $this->commentBody;
    }

    public static function fromArray(array $value): self
    {
        return new self(
            SenderId::of($value['sender_id']),
            ReceiverId::of($value['receiver_id']),
            BikeId::of($value['bike_id']),
            CommentBody::of($value['body'])
        );
    }
}
