<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use Core\src\Bike\Domain\Models\BikeId;
use Core\src\Comment\UseCase\GetComment;
use Core\src\User\Domain\Models\UserId;

class GetMessagesController extends Controller
{
    private $useCase;

    public function __construct(GetComment $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(
        int $loginUserId,
        int $anotherUserId,
        int $bikeId
    ) {
        $loginUserId = UserId::of($loginUserId);
        $anotherUserId = Userid::of($anotherUserId);
        $bikeId = BikeId::of($bikeId);
        $usersComments = $this->useCase->execute($loginUserId, $anotherUserId, $bikeId);
        $loginUserCommentList = $usersComments[0]->items();
        $anotherUserCommentList = $usersComments[1]->items();
        return response()->json(
            [
                "loginUserComments" => $loginUserCommentList,
                "anotherUserComments" => $anotherUserCommentList
            ]
        );
    }
}
