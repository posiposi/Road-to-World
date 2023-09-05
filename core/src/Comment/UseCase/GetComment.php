<?php

namespace Core\src\Comment\UseCase;

use Core\src\Bike\Domain\Models\BikeId;
use Core\src\User\Domain\Models\UserId;
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
        UserId $loginUserId,
        UserId $anotherUserId,
        BikeId $bikeId
    ) {
        $fromLoginUserToAntherUserComments = $this->getCommentQueryPort->getCommentList(
            SenderId::of($loginUserId->toInt()),
            ReceiverId::of($anotherUserId->toInt()),
            $bikeId
        );
        $fromAnotherUserToLoginUserComments = $this->getCommentQueryPort->getCommentList(
            SenderId::of($anotherUserId->toInt()),
            ReceiverId::of($loginUserId->toInt()),
            $bikeId
        );
        // dd($fromAnotherUserToLoginUserComments);
        return [$fromLoginUserToAntherUserComments, $fromAnotherUserToLoginUserComments];
    }
}
